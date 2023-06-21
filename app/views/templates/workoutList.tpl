{extends file="main.tpl"}
{block name=top}  {include file='messages.tpl'} {/block}
{block name=bottom}
    <div class="wrapper">
        <div class="inner">
            <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Lorem1</th>
                        <th>Lorem2</th>
                        <th>Lorem3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                    </tr>
                </tbody>
            </table>
            <ul class="pagination">
                <li><a href="#" class="button small disabled">Prev</a></li>
                <li><a href="#" class="page active">1</a></li>
                <li><a href="#" class="page">2</a></li>
                <li><a href="#" class="page">3</a></li>
                <li><a href="#" class="button small">Next</a></li>
            </ul>
            </div>
        </div>
    </div>
{/block}
