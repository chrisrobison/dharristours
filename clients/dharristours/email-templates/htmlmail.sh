#!/bin/bash

# Function to display usage information
function display_usage {
  echo "Usage: $0 [-s SUBJECT] [-f FROM] [-t TO] <input_file_or_url>"
  echo ""
  echo "Options:"
  echo "  -s SUBJECT  Subject of the email (default: HTML Email)"
  echo "  -f FROM     Sender email address (default: sender@example.com)"
  echo "  -t TO       Recipient email address (default: recipient@example.com)"
  echo "  -c CC       CC email address (default: none)"
  echo "  -b BCC      BCC email address (default: none)"
  echo "  -h          Display this help information"
}

# Check if input file or URL is provided
if [ $# -eq 0 ]; then
  display_usage
  exit 1
fi

# Default values for command-line arguments
subject="HTML Email"
from="sender@example.com"
to="recipient@example.com"
bcc="cdr@netoasis.net"

# Parse command-line arguments
while getopts ":s:f:c:t:b:h" opt; do
  case $opt in
    s)
      subject="$OPTARG"
      ;;
    f)
      from="$OPTARG"
      ;;
    t)
      to="$OPTARG"
      ;;
    c) 
      cc="$OPTARG"
      ;;
    b)
      bcc="$OPTARG"
      ;;
    h)
      display_usage
      exit 0
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      display_usage
      exit 1
      ;;
    :)
      echo "Option -$OPTARG requires an argument." >&2
      display_usage
      exit 1
      ;;
  esac
done
shift $((OPTIND -1))

# Get the content of the input file or URL
if [[ $1 == http* ]]; then
  content=$(curl -s $1)
else
  content=$(cat $1)
fi

# Get the images and external assets used in the HTML content
images=$(echo "$content" | grep -oP '(?<=img src=")[^"]+(?=")')
assets=$(echo "$content" | grep -oP '(?<=link rel="stylesheet" href=")[^"]+(?=")')

boundary="Mail=_$(uuidgen)"

# Download the images and external assets and convert them to MIME attachments
attachments=""
for img in $images $assets; do
  attachment=$(echo "$img" | awk -F/ '{print $NF}')
  curl -s "$img" -o "$attachment"
  mimetype=$(file -b --mime-type "$attachment")
  uuid=$(uuidgen)
  attachment_cid=$uuid
  attachments="$attachments
--$boundary
Content-Type: $mimetype
Content-Transfer-Encoding: base64
Content-Disposition: inline; filename=\"$attachment\"
Content-ID: <$attachment_cid>

$(base64 -w 76 "$attachment")"
  content=$(echo "$content" | perl -p -e "s|$img|cid:$attachment_cid|")
done

# Create the email template
echo "From: $from
To: $to
Bcc: patrick@dharristoursmail.com, $bcc
Subject: $subject
MIME-Version: 1.0
Content-Type: multipart/alternative; boundary=\"$boundary-alt\"

--$boundary-alt
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 7bit

This is a MIME email with HTML content.

--$boundary-alt
Content-Type: multipart/related; type=\"text/html\"; boundary=\"$boundary\"

--$boundary
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: 7bit

$content

$attachments

--$boundary--

--$boundary-alt--" 

# Remove the downloaded attachments
#rm -f $attachments

