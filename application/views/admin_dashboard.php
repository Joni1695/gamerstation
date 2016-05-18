  <div class="col-md-12">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading mypanel">
          <h1>Most Sold Games</h1>
        </div>
        <div class="panel-body">
          <table class="table mytable1">
            <thead>
              <tr>
                <th>
                  Total Sale
                </th>
                <th>
                  Product Title
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($mostsold as $ms) :?>
                <tr>
                  <td>
                    <?php echo $ms->Total_sale; ?>
                  </td>
                  <td>
                    <?php echo $ms->Title; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading mypanel">
          <h1>Most Buying Users</h1>
        </div>
        <div class="panel-body">
          <table class="table mytable1">
            <thead>
              <tr>
                <th>
                  Total Sale
                </th>
                <th>
                  Username
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($usersold as $us) :?>
                <tr>
                  <td>
                    <?php echo $us->Total_sale; ?>
                  </td>
                  <td>
                    <?php echo $us->Username; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading mypanel">
        <h1>Most Highest Purchases</h1>
      </div>
      <div class="panel-body">
        <table class="table mytable1">
          <thead>
            <tr>
              <th>
                Total Value
              </th>
              <th>
                Username
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($purchases as $us) :?>
              <tr>
                <td>
                  <?php echo $us->Total_value; ?>
                </td>
                <td>
                  <?php echo $us->Username; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
