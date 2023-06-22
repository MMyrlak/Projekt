{extends file="main.tpl"}
{block name=top}  {include file='messages.tpl'} {/block}
{block name=bottom}
    <div class="wrapper">
        <div class="inner">
                <div class="workout">
                    {foreach $workout as $elem}
			<a href="#?id_workout={$elem["id_workout"]}" class="card">
                            <img src="{$conf->app_url}/images/{$elem["photo"]}" alt="{$elem["name_workout"]}" style="width:100%">
                            <div class="container">
                                <p><b>{$elem["name_workout"]}</b></p> 
                            </div>	
			</a>	
                    {/foreach}
		</div>
            <ul class="pagination">
                <li><a href="#" class="button small disabled">Prev</a></li>
                <li><a href="#" class="page active">1</a></li>
                <li><a href="#" class="page">2</a></li>
                <li><a href="#" class="page">3</a></li>
                <li><a href="#" class="button small">Next</a></li>
            </ul>
            </div>
        </div>
{/block}
