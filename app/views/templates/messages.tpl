{if true}
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