{extends file="main.tpl"}
    {block name=top}
        <div class="col-6 col-12-xsmall" style='width: 50%; margin: auto'>
                <form id="body_parts" onsumbit="ajaxPostForm('body_parts','{url action='workoutPartListShow'}','workoutTable'); return false;">
                <select id="body_parts_select" name="body_parts_select">
                        <option value="0">----</option>
                        {foreach $body_parts as $body}
                        {strip}
                            <option value='{$body["id_body_parts"]}'>{$body["name"]}</option>
                        {/strip}
                    {/foreach}
                    </select>
                    <button type="submit" class="primary">Filtruj</button>
        </form>
    </div>           
    {/block}
    
{block name=bottom}
    <div class="wrapper">
        {include file='messages.tpl'}
        <div class="inner" id="workoutTable">
        {include file='workoutTable.tpl'}
        </div>
{/block}
