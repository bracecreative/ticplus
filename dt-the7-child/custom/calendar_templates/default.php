      <?php foreach($calendar as $year => $months) { $last_month=''; ?>
      <h3 class="has-accent-color has-text-color"><?=$year?></h3>
        <?php foreach($months as $month => $events) { ?>
        <figure class="wp-block-table is-style-regular">
          <table><tbody>        

          <?php foreach($events as $e) { ?>

            <tr>
             <td><?=($last_month==$month?'':$month)?></td>
             <td><?=date('d',$e->event_date)?></td>
             <td><a href="<?=$e->event_url?>"><?=$e->title?></a></td>
            </tr>

          <?php $last_month = $month; }  ?>

          </tbody></table>
        </figure>

        <?php } ?>

      <?php } ?>