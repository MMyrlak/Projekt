{extends file="main.tpl"}
{block name=top}  {/block}
{block name=bottom}	
    {include file='messages.tpl'}
    <div class="wrapper">
        <div class="inner workoutPage">
            {if $favorite == 0}<a href="{url action='favorite'}/0/{$workout[0]['id_workout']}" class='favorite'><i class="fa-regular fa-star fa-2xl" style="color: #0054e6;"></i></a>
            {elseif $favorite == 1} <a href="{url action='favorite'}/1/{$workout[0]['id_workout']}"><i class="fa-solid fa-star fa-2xl favorite" style="color: #0054e6;"></i></a>
            {else $favorite == 2} {/if}
            <video controls autoplay loop>
                <source src="{$workout[0]['video']}" type="video/mp4">
            </video>
            <h1>Partia miesni: TBA</h1>
            <h1>Pozycja wyjsciowa</h1>
            <p>{$workout[0]['position']}</p>
            <h1>Ruch</h1>
            <p>{$workout[0]['move']}</p>
        </div>
    </div>
{/block}