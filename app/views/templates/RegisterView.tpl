{extends file="main.tpl"}
{block name=bottom}
    <div class="wrapper">	
        {include file='messages.tpl'}
        <div class="inner">
            <form method="post" action="{$conf->action_root}register" enctype="multipart/form-data">
                <div class="row gtr-uniform register-login-form">
                    <div class="col-8">
                        <label for="name">Email</label>
                        <input type="email" name="email" id="email" value="{$form->email}" placeholder="Wpisz e-mail"/>
                    </div>
                    <div class="col-8">
                        <label for="name">Login</label>
                        <input type="text" name="login" id="login" value="{$form->login}" placeholder="Wpisz login"/>
                    </div>  
                    <div class="col-8">
                        <label for="name">Haslo</label>
                        <input type="password" name="password" id="password" value="" placeholder="Wpisz haslo"/>
                    </div>
                    <div class="col-8">
                        <ul class="actions">
                            <li><input type="submit" value="Zarejestruj" class="primary" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
 {/block}