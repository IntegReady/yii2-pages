<div class="pages-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>

    <span style='color: red; font-size: 40px'>УРА ! Мой модуль работает!<br></span>>

    This is the view content for action "<?= $this->context->action->id ?>".
    The action belongs to the controller "<?= get_class($this->context) ?>"
    in the "<?= $this->context->module->id ?>" module.
    </span>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
