#!/bin/bash

# Function to display usage information
function display_usage {
  echo "Usage: $0 [-s SUBJECT] [-f FROM] [-t TO] <input_file_or_url>"
  echo ""
  echo "Creates HTML MIME email from HTML file or URL.  Adds any "
  echo "external images or files as encoded MIME attachments and updates"
  echo "the HTML source to reference internal assets."
  echo ""
  echo "Options:"
  echo "  -s SUBJECT  Subject of the email (default: HTML Email)"
  echo "  -f FROM     Sender email address (default: sender@example.com)"
  echo "  -t TO       Recipient email address (default: recipient@example.com)"
  echo "  -h          Display this help information"
}

# Check if input file or URL is provided
if [ $# -eq 0 ]; then
  display_usage
  exit 1
fi

# Default values for command-line arguments
subject="HTML Email"
from="info@dharristours.com"
to="cdr@netoasis.net"

# Parse command-line arguments
while getopts ":s:f:t:h" opt; do
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

# Download the images and external assets and convert them to MIME attachments
attachments=""
for img in $images $assets; do
  attachment=$(echo "$img" | awk -F/ '{print $NF}')
  curl -s "$img" -o "$attachment"
  mimetype=$(file -b --mime-type "$attachment")
  attachment_cid=$(uuidgen)@example.com
  attachments="$attachments
--$boundary
Content-Type: $mimetype
Content-Transfer-Encoding: base64
Content-Disposition: inline; filename=\"$attachment\"
Content-ID: <$attachment_cid>

$(base64 -w 0 "$attachment")"
  content=$(echo "$content" | sed "s|$img|cid:$attachment_cid|")
done

# Create the email template
boundary=$(uuidgen)
echo "From: $from
To: $to
Subject: $subject
MIME-Version: 1.0
Content-Type: multipart/related; boundary=\"$boundary\"

--$boundary
Content-Type: multipart/alternative; boundary=\"$boundary-alt\"

--$boundary-alt
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 7bit

This is a MIME email with HTML content.

--$boundary-alt
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: 7bit

$content

$attachments

--$boundary-alt--

--$boundary--" > email.html

# Remove the downloaded attachments
rm -f $attachments
