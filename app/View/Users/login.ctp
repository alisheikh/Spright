<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall" style="text-align:center;">
                <img  src="/images/logoWide.png" style="padding:0 0 20px 0"
                    alt="Spright logo">
                    <?php echo $this->Session->flash(); ?>
                             <?php
echo $this->Form->create('User', array('class'=>'form-signin',
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    )
));?>

                <?php echo $this->Form->input('User.username', array('class' => 'form-control', 'placeholder' => 'Enter your username','label'=> false, 'autofocus'=>'autofocus'));?>
                 <?php echo $this->Form->input('User.password', array('class' => 'form-control', 'placeholder' => 'Enter your password','label'=> false,'type'=>'password'));?>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember_me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            
        </div>
    </div>
</div>

