<!DOCTYPE html>
<html>
<head>
    <title>ajax with php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        margin-top: 20px;
    }
    li {
        width: 400px;
    }
    select {
        width: 350px;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">LearnVern | Task</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="card" style="margin: 1%;">
        <h5 class="card-header">Location Data</h5>
        <div class="card-body">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><b>Countries</b><hr>
                    <select id="country_dropdown">
                        <option value="" disabled="" selected="">-----------------Select Country-----------------</option>
                    </select>

                  </li>
                  <li class="list-group-item"><b>States</b><hr>
                    <select id="state_dropdown">
                        <option value="" disabled="" selected="">-----------------Select State-----------------</option>
                    </select>
                </li>
                <li class="list-group-item"><b>Cities</b><hr>
                    <select id="city_dropdown">
                        <option value="" disabled="" selected="">-----------------Select City-----------------</option>
                    </select>
                </li>
            </ul>
            

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- 2 write start jquery for ajax -->
    <script type="text/javascript">
        $(function () {
            // 2 call new function
            LoadCountries();
        });
        // 6 after change the country dropdown id
        $('#country_dropdown').change(function(){
            // 15 when change country then default
            $('#city_dropdown').empty();
            $('#city_dropdown').append('<option value="" disabled="" selected="">-----------------Select City-----------------</option>');

            // call new function with id
            LoadStates(this.value);        
        });
        // 14 after change the state dropdown id
        $('#state_dropdown').change(function(){
        // call new function with id
        Loadcities(this.value);        
        });
        // 3 create new fuction
        function LoadCountries(){
            // 4 use the Rest API by ajax - from Controller
            $.ajax({
                type : 'get',
                url : 'http://localhost/php-and-ajax/getCountrisData',
                data : {

                },
                cache : false,
                dataType : 'text',
                success : function(data){
                    // console.log(data);

                    // 5 show country data in html
                    $('#country_dropdown').append(data);
                }

            })
        }
        // 7 create new fuction for load
        function LoadStates(country_id){
            // 8 use the Rest API by ajax - from Controller
            $.ajax({
                type : 'post',
                url : 'http://localhost/php-and-ajax/getStatesData',
                data : {
                    'country' : country_id
                },
                cache : false,
                dataType : 'text',
                success : function(data){
                    // console.log(data);

                    // 9 show state data in html
                    $('#state_dropdown').empty(data);// empty data
                    $('#state_dropdown').append(data); // then execute
                }

            })
        }
        // 11 create new fuction for city load
        function Loadcities(state_id){
            // 12 use the Rest API by ajax - from Controller
            $.ajax({
                type : 'post',
                url : 'http://localhost/php-and-ajax/getCitiesData',
                data : {
                    'state' : state_id
                },
                cache : false,
                dataType : 'text',
                success : function(data){
                    // console.log(data);

                    // 13 show state data in html
                    $('#city_dropdown').empty(data);// empty data
                    $('#city_dropdown').append(data); // then execute
                }

            })
        }
    </script>
</body>
</html>