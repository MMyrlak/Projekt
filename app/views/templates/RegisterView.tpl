{extends file="main.tpl"}
{block name=top} {include file='messages.tpl'} {/block}
{block name=bottom}
<div class="wrapper">	
    <div class="inner">
        <form method="post" action="{$conf->action_root}register" enctype="multipart/form-data">
            <div class="row gtr-uniform register-login-form">
                <div class="col-8">
                    <label for="name">Login</label>
                    <input type="text" name="login" id="login" value="" placeholder="Wpisz login"/>
                </div>
                <div class="col-8">
                    <label for="name">Has³o</label>
                    <input type="password" name="password" id="password" value="" placeholder="Wpisz has³o"/>
                </div>
                <div class="col-8">
                    <ul class="actions">
                        <li><input type="submit" value="Zaloguj" class="primary"/></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>
 {/block}