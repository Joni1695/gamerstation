<div class="content">
  <?php if (sizeof($orders)!=0): ?>
  <table class="table table-striped table-hover mytable">
    <thead>
      <tr>
        <th>
          Product
        </th>
        <th>
          Price
        </th>
        <th>
          Quantity
        </th>
        <th>
          TransactionID
        </th>
        <th>
          Address
        </th>
        <th>
          Address2
        </th>
        <th>
          State
        </th>
        <th>
          City
        </th>
        <th>
          Zipcode
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $o) :?>
        <tr>
          <td>
            <?php echo $o->title; ?>
          </td>
          <td>
            <?php echo $o->price; ?>
          </td>
          <td>
            <?php echo $o->qty; ?>
          </td>
          <td>
            <?php echo $o->transaction_id; ?>
          </td>
          <td>
            <?php echo $o->adress; ?>
          </td>
          <td>
            <?php echo $o->adress2; ?>
          </td>
          <td>
            <?php echo $o->state; ?>
          </td>
          <td>
            <?php echo $o->city; ?>
          </td>
          <td>
            <?php echo $o->zipcode; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if(sizeof($orders)<5) for($i=0;$i<5-sizeof($orders);$i++) echo '<br><br>'; ?>
  <?php else : ?>
    <p>
      You have made no purchases.
    </p><br><br><br><br><br><br><br><br><br><br><br>
  <?php endif; ?>
</div>
