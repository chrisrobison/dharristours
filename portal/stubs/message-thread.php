<?php
?>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Messages</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
          <div class="row">
            <div class="col-12 message-list">
            </div>
          </div>
        </div>
      </div>
      <div class="card-header no-left-padd">
        <p class="card-title">Compose New Message</p>
      </div>
      <form id="messageForm">
        <div class="submit-overlay"></div>
        <input type="hidden" name="resource_id" value="<?= $MSG_RESOURCE_ID ?>" />
        <input type="hidden" name="resource_type" value="<?= $MSG_RESOURCE_TYPE ?>" /><!-- todo - get resource type from page - JJ -->
        <div class="form-group">
          <textarea id="compose-textarea" name="content" class="form-control" required></textarea>
        </div>
        <div class="card-footer">
          <div class="float-right">
            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
          </div>
        </div>
      </form>
      <div class="text-center message-fail">
        We're sorry :(<br />
        Something went wrong when sending your message.<br />
        Please try again later or <a href="mailto:juanaharrisdht@att.net">contact us</a> so that we may assist you.
      </div>
      <div class="message-success">
        Thank you!<br />
        Your message has been posted.<br />
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
<?php
