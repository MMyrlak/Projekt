{extends file="main.tpl"}
{block name=top}  {/block}
{block name=bottom}
<div class="wrapper">	
    {include file='messages.tpl'}
    <div class="inner">
        <form method="post" action="{$conf->action_root}addWorkout" enctype="multipart/form-data">
            <div class="row gtr-uniform">
                <div class="col-6 col-12-xsmall">
                    <label for="name">Nazwa</label>
                    <input type="text" name="name" id="name" value="" />
                </div>
                <div class="col-6 col-12-xsmall">
                    <label for="demo-category">Category</label>
                    <select name="body_parts" id="body_parts">
                        <option value="">----</option>
                        {foreach $body_parts as $body}
                        {strip}
                            <option value='{$body["name"]}'>{$body["name"]}</option>
                        {/strip}
                    {/foreach}
                        
                    </select>
                </div>
                <div class="col-6 col-12-xsmall">
                    <label for="video">Film instruktarzowy</label>
                    <input type="text" name="video" id="video" value="" />
                </div>
                <div class="col-6 col-12-xsmall">
                    <label for="photo">Zdjêcie pogl¹dowe</label>
                    <input style="padding-top: 0.35em;" type="file" name="photo" id="photo" accept="image/*" >
                </div>  
                <div class="col-6 col-12-xsmall">
                    <label for="position-message">Pozycja</label>
                    <textarea name="position" id="position" rows="6"></textarea>
                </div>
                <div class="col-6 col-12-xsmall">
                    <label for="move-message">Ruch</label>
                    <textarea name="move" id="move" rows="6"></textarea>
                </div>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" value="Dodaj" class="primary" /></li>
                        <li><input type="reset" value="Resetuj" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}