{if $msgs_count>=1}
 <div class="alert succes">
        <ul class="alt">
            {foreach $msgs as $msg}
                {strip}
                    <li>{$msg->text}</li>
                {/strip}
            {/foreach}
        </ul>
 </div>
{/if}