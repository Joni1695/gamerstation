<div class="col-md-12">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Orders</h2>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-hover mytable">
          <thead>
            <tr>
              <th>
                Username
              </th>
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
                  <?php echo $o->username; ?>
                </td>
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
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
