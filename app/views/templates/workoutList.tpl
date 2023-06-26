{extends file="main.tpl"}
    {block name=top}    
        <div class="col-6" style='width: 50%; margin: auto'>
                <select id="body_parts_select" name="body_parts_select" onchange="javascript:handleSelect(this)">
                        <option value="0">----</option>
                        {foreach $body_parts as $body}
                        {strip}
                            <option value='{url action="workoutListShow"}/0/{$body["id_body_parts"]}' {if $body_parts_offset == $body["id_body_parts"]} selected="selected" {/if}>{$body["name"]}</option>
                        {/strip}
                    {/foreach}
                    </select>
    </div>           
            <script type="text/javascript">
              function handleSelect(elm)
              {
                 window.location = elm.value;
              }
</script>
    {/block}
    
{block name=bottom}
    <div class="wrapper">
        {include file='messages.tpl'}
        <div class="inner" id="workoutTable">
        {include file='workoutTable.tpl'}
        </div>
{/block}
