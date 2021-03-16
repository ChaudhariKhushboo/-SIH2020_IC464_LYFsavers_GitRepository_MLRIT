<br />
<?php<br />
$con  = mysqli_connect("localhost","root","","salesdb");<br />
 if (!$con) {<br />
     # code...<br />
    echo "Problem in database connection! Contact administrator!" . mysqli_error();<br />
 }else{<br />
         $sql ="SELECT * FROM tblsales";<br />
         $result = mysqli_query($con,$sql);<br />
         $chart_data="";<br />
         while ($row = mysqli_fetch_array($result)) { </p>
<p>            $productname[]  = $row['Product']  ;<br />
            $sales[] = $row['TotalSales'];<br />
        }</p>
<p> }</p>
<p>?><br />
<!DOCTYPE html><br />
<html lang="en"><br />
    <head><br />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><br />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><br />
        <title>Graph</title><br />
    </head><br />
    <body><br />
        <div style="width:60%;hieght:20%;text-align:center"><br />
            <h2 class="page-header" >Analytics Reports </h2><br />
            <div>Product </div><br />
            <canvas  id="chartjs_bar"></canvas><br />
        </div><br />
    </body><br />
  <script src="//code.jquery.com/jquery-1.9.1.js"></script><br />
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script><br />
<script type="text/javascript"><br />
      var ctx = document.getElementById("chartjs_bar").getContext('2d');<br />
                var myChart = new Chart(ctx, {<br />
                    type: 'bar',<br />
                    data: {<br />
                        labels:<?php echo json_encode($productname); ?>,<br />
                        datasets: [{<br />
                            backgroundColor: [<br />
                               "#5969ff",<br />
                                "#ff407b",<br />
                                "#25d5f2",<br />
                                "#ffc750",<br />
                                "#2ec551",<br />
                                "#7040fa",<br />
                                "#ff004e"<br />
                            ],<br />
                            data:<?php echo json_encode($sales); ?>,<br />
                        }]<br />
                    },<br />
                    options: {<br />
                           legend: {<br />
                        display: true,<br />
                        position: 'bottom',</p>
<p>                        labels: {<br />
                            fontColor: '#71748d',<br />
                            fontFamily: 'Circular Std Book',<br />
                            fontSize: 14,<br />
                        }<br />
                    },</p>
<p>                }<br />
                });<br />
    </script><br />
</html></p>
<p>
