<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PATH</title>
    <link rel="stylesheet" href="./MainPage.css">
    <script src="https://kit.fontawesome.com/c881082b49.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./jquery.min.js"></script>
<script type="text/javascript" src="./Chart.min.js"></script>
</head>
<body id=body-pd>
    <?php
    $conn=mysqli_connect('localhost','root','root','path');
    session_start();
    ?>
    <div class="top">

        <div class="Title">
        PATH
        </div>
        <div class="Login">
            <?php
            if(isset($_SESSION['user_id'])) {
            ?>
                 <button type="button" aria-label="Logout" class="Login-button" onClick="location.href='Logout.php'">
                Logout
                </button>

        <?php
            }
            else{
         
        ?>
        <button type="button" aria-label="Login" class="Login-button" onClick="location.href='로그인.php'">
                Login
        </button>
        <?php
            }
        ?>
        </div>

    </div>
    <div class="topbar" style="position: absolute; top:0;">
        
        <!-- 왼쪽 서브 메뉴 -->
        <div class="left_side_bar">
            <div class="Ku">
                <h2>구별 검색</h2>
                <ul class="Ku_list ">
                    <li>ㄱ<i class="arrow fas fa-angle-right "></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >강동구</a></li>
                        <li><a href="#" >광진구</a></li>
                        <li> <a href="#" >강북구</a></li>
                        <li><a href="#" >강서구</a></li>
                        <li><a href="#" >구로구</a></li>
                        <li><a href="#" >금천구</a></li>
                        <li><a href="#" >관약구</a></li>
                        <li><a href="#" >강남구</a></li>

                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㄴ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >노원구</a></li>

                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㄷ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >동대문구</a></li>
                        <li><a href="#" >도봉구</a></li>
                        <li><a href="#" >동작구</a></li>
    

                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㅁ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >마포구</a></li>


                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㅅ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >송파구</a></li>
                        <li><a href="#" >서초구</a></li>
                        <li><a href="#" >서대문구</a></li>
                        <li><a href="#" >성북구</a></li>
                        <li><a href="#" >성동구</a></li>
    

                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㅇ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >용산구</a></li>
                        <li><a href="#" >은평구</a></li>
                        <li> <a href="#" >양천구</a></li>
                        <li><a href="#" >영등포구</a></li>
    

                    </ul>
                </ul>
                <ul class="Ku_list ">
                    <li>ㅈ<i class="arrow fas fa-angle-right"></i></li>
                    <ul class="specific_Ku">
                        <li><a href="#" >중랑구</a></li>
                        <li><a href="#" >중구구</a></li>
                        <li><a href="#" >종로구</a></li>
    

                    </ul>
                </ul>

            </div>
            <div class="Ku">
                <h2>호선별 검색</h2>
            </div>
            <ul class="specific_Line">
                <li><a href="#">1호선</a></li>
                <li><a href="#">2호선</a></li>
                <li><a href="#">3호선</a></li>
                <li><a href="#">4호선</a></li>
                <li><a href="#">5호선</a></li>
                <li><a href="#">6호선</a></li>
                <li><a href="#">7호선</a></li>
                <li><a href="#">8호선</a></li>
                <li><a href="#">9호선</a></li>
            </ul>
        </div>
    </div>
    </div>

    <div class="searchbox">

        <input onkeyup="filter()" type="text" class="search" placeholder="Type to Search">
        <input type="button" class='search_button' value="검색" onclick="myFunction()"/>
    </div>
    
<!--통계-->
    <div class=statics>
    <canvas id="graphCanvas"></canvas>
    </div>
    <script>
        $(document).ready(function () {
        showGraph();
    });


    function showGraph()
    {
        {
            $.post("data.php",
            function (data)
            {
                console.log(data);
                var district= [];
                var population = [];

                for (var i in data) {
                    district.push(data[i].district);
                    population.push(data[i].population);
                }

                var chartdata = {
                    labels: district,
                    datasets: [
                        {
                            label: 'population',
                            backgroundColor: 'white',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: population
                        }
                    ]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
        }
    }
</script>

<script>
    $(function () {
   
        // 왼쪽메뉴 드롭다운
        $(".Ku ul.specific_ku").hide();
        $(".Ku ul.Ku_list").click(function () {
            $("ul", this).slideToggle(300);
        });
        // 외부 클릭 시 좌측 사이드 메뉴 숨기기
        $('.overlay').on('click', function () {
            $('.left_sub_menu').fadeOut();
            $('.hide_sidemenu').fadeIn();
        });
    });
</script>
</body>