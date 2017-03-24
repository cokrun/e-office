

window.onload = function(){

	var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};


	var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

	var hariIni = new Date();
	var jumlahBalikHari = 30;//Math.round(hariIni.getDate() / 2);
	var daftar7HariBelakang = [];
	var daftar7TglBelakang = [];

	for(var i=0;i<jumlahBalikHari;i++) {
		var tglBaru = new Date(hariIni.setDate(hariIni.getDate() - 1));
		daftar7HariBelakang.push(/*hari[tglBaru.getDay()] + " - " + */tglBaru.getDate() + "/" + tglBaru.getMonth());
		daftar7TglBelakang.push(tglBaru.getFullYear() + "-" + tglBaru.getMonth() + "-" + tglBaru.getDate());
	}


    $.ajax({
        method: "POST",
        url: "http://" + window.location.host + "/disposisi/ajax/hitung_surat_per_tanggal/",
		data: {
			tanggal: JSON.stringify(daftar7TglBelakang)
		},
        success: function(response) {
            var lineChartData = {
                labels : daftar7HariBelakang.reverse(),
                datasets : [
                    {
                        label: "Surat",
                        fillColor : "rgba(220,220,220,0.2)",
                        strokeColor : "rgba(220,220,220,1)",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                        data : [response.surat[6],response.surat[5],response.surat[4],response.surat[3],response.surat[2],response.surat[1],response.surat[0]]
                    },
                    {
                        label: "Disposisi",
                        fillColor : "rgba(48, 164, 255, 0.2)",
                        strokeColor : "rgba(48, 164, 255, 1)",
                        pointColor : "rgba(48, 164, 255, 1)",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(48, 164, 255, 1)",
                        data : [response.disposisi[6],response.disposisi[5],response.disposisi[4],response.disposisi[3],response.disposisi[2],response.disposisi[1],response.disposisi[0]]
                    }
                ]
            };

            // var barChartData = {
            //    labels: ["January", "February", "March", "April", "May", "June", "July"],
            //    datasets: [
            //        {
            //            fillColor: "rgba(220,220,220,0.5)",
            //            strokeColor: "rgba(220,220,220,0.8)",
            //            highlightFill: "rgba(220,220,220,0.75)",
            //            highlightStroke: "rgba(220,220,220,1)",
            //            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            //        },
            //        {
            //            fillColor: "rgba(48, 164, 255, 0.2)",
            //            strokeColor: "rgba(48, 164, 255, 0.8)",
            //            highlightFill: "rgba(48, 164, 255, 0.75)",
            //            highlightStroke: "rgba(48, 164, 255, 1)",
            //            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            //        }
            //    ]
            //
            // }
            //
            // var pieData = [
            // 			{
            // 				value: 300,
            // 				color:"#30a5ff",
            // 				highlight: "#62b9fb",
            // 				label: "Blue"
            // 			},
            // 			{
            // 				value: 50,
            // 				color: "#ffb53e",
            // 				highlight: "#fac878",
            // 				label: "Orange"
            // 			},
            // 			{
            // 				value: 100,
            // 				color: "#1ebfae",
            // 				highlight: "#3cdfce",
            // 				label: "Teal"
            // 			},
            // 			{
            // 				value: 120,
            // 				color: "#f9243f",
            // 				highlight: "#f6495f",
            // 				label: "Red"
            // 			}
            //
            // 		];
            //
            // var doughnutData = [
            // 				{
            // 					value: 300,
            // 					color:"#30a5ff",
            // 					highlight: "#62b9fb",
            // 					label: "Blue"
            // 				},
            // 				{
            // 					value: 50,
            // 					color: "#ffb53e",
            // 					highlight: "#fac878",
            // 					label: "Orange"
            // 				},
            // 				{
            // 					value: 100,
            // 					color: "#1ebfae",
            // 					highlight: "#3cdfce",
            // 					label: "Teal"
            // 				},
            // 				{
            // 					value: 120,
            // 					color: "#f9243f",
            // 					highlight: "#f6495f",
            // 					label: "Red"
            // 				}
            //
            // 			];
            var chart1 = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true
            });
            // var chart2 = document.getElementById("bar-chart").getContext("2d");
            // window.myBar = new Chart(chart2).Bar(barChartData, {
            // 	responsive : true
            // });
            // var chart3 = document.getElementById("doughnut-chart").getContext("2d");
            // window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
            // });
            // var chart4 = document.getElementById("pie-chart").getContext("2d");
            // window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
            // });



        }
    });

	
};