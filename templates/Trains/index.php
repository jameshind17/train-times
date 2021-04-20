<?= $this->Html->css('styles', ['block' => true]); ?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', ['block' => true]); ?>
<?= $this->Html->script('scripts', ['block' => true]); ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12 chat">
            <div class="card">
                <div class="card-body msg-card-body">
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <textarea name="message" class="form-control type-msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send-btn"><i class="fas fa-location-arrow"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var csrfToken = <?= json_encode($this->request->getAttribute('csrfToken')) ?>;
</script>
