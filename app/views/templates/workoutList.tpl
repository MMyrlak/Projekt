{extends file="main.tpl"}
{block name=top}  {include file='messages.tpl'} {/block}
{block name=bottom}
    <div class="wrapper">
        <div class="inner">
                <div class="workout">
                    {foreach $workout as $elem}
                        {if $smarty.foreach.foo.index == 10}{break}{/if}
			<a href="#?id_workout={$elem["id_workout"]}" class="card">
                            <img src="{$conf->app_url}/images/{$elem["photo"]}" alt="{$elem["name_workout"]}" style="width:100%">
                            <div class="container">
                                <p><b>{$elem["name_workout"]}</b></p> 
                            </div>	
			</a>	
                    {/foreach}
		</div>
            <ul class="pagination">
                <li><a href="{url action='pagination'}/ {if $offset!=0}{$offset-1}{/if}" class="button small {if true} disable {/if}">Prev</a></li>
                <li><a href="{url action='pagination'}/{$offset}" class="page">{$offset}</a></li>
                {if ($offset*10)+1<$workout_count}
                <li><a href="{url action='pagination'}/{$offset+1}" class="page">{$offset + 1}</a></li>
                {/if}{if ($offset*10)+2<$workout_count}
                <li><a href="{url action='pagination'}/{$offset+2}" class="page">{$offset + 2}</a></li>
                {/if}
                <li><a href="{url action='pagination'}/{$offset+1}"" class="button small {if $workout_count>10}disabled{/if}">Next</a></li>
            </ul>
            </div>
        </div>
{/block}
