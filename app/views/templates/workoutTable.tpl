<ul class="pagination">
                <li><a href="{url action='workoutPartListShow()'}/{$offset-1}" class="button small {if $offset==0} disabled {/if}">Prev</a></li>
                <li><a href="{url action='workoutListShow'}/{$offset+1}" class="button small {if $workout_count<13}disabled{/if}">Next</a></li>
            </ul>
<div class="workout" id='workout'>
                    {foreach $workout as $elem}
                        {if $elem@iteration == 13}{break}{/if}
			<a href="{url action='workoutWebShow'}/{$elem["id_workout"]}" class="card col-4-large col-6-medium col-12-small">
                            <img src="{$conf->app_url}/images/{$elem["photo"]}" alt="{$elem["name_workout"]}" style="width:100%">
                            <div class="container">
                                <p><b>{$elem["name_workout"]}</b></p> 
                            </div>	
			</a>	
                    {/foreach}
		</div>
                <ul class="pagination">
                <li><a href="{url action='workoutListShow'}/{$offset-1}" class="button small {if $offset==0} disabled {/if}">Prev</a></li>
                <li><a href="{url action='workoutListShow'}/{$offset+1}" class="button small {if $workout_count<13}disabled{/if}">Next</a></li>
            </ul>
</div>

