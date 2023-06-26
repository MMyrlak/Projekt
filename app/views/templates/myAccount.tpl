{extends file="main.tpl"}
{block name=top} {/block}
{block name=bottom}
    <div class="wrapper">
        <div class="inner">
            {if $workout_count > 0}
                <h1>Ulubione:</h1>
                    <ul class="pagination">
                        <li><a href="{url action='myAccount'}/{$offset-1}" class="button small {if $offset==0} disabled {/if}" style="pointer-events: {if $offset==0} none {else} auto {/if}">Prev</a></li>
                        <li><a href="{url action='myAccount'}/{$offset+1}" class="button small {if $workout_count<13}disabled{/if}" style="pointer-events: {if $workout_count<13} none {else} auto {/if}">Next</a></li>
                    </ul>
            {else} 
                <h1>Brak ulubionych</h1>
            {/if}
            
                <div class="workout">
                    {foreach $workout as $elem}
                        {if $elem@iteration == 13}{break}{/if}
			<a href="{url action='workoutWebShow'}/{$elem["id_workout"]}" class="card">
                            <img src="{$conf->app_url}/images/{$elem["photo"]}" alt="{$elem["name_workout"]}" style="width:100%">
                            <div class="container">
                                <p><b>{$elem["name_workout"]}</b></p> 
                            </div>	
			</a>	
                    {/foreach}
		</div>
            </div>
        </div>
{/block}