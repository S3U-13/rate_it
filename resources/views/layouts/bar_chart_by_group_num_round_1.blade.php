<div id="chart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // ข้อมูลที่ได้จาก PHP
    var results = @json($results);

    // แปลงข้อมูลให้อยู่ในรูปแบบที่ ApexCharts ใช้ได้
    var groupNames = []; // ชื่อกลุ่ม
    var avgScores = []; // ค่าเฉลี่ยคะแนนของแต่ละกลุ่ม
    var colors = []; // สีของแต่ละกลุ่ม

    // กำหนดสีสำหรับแต่ละกลุ่ม
    var colorPalette = [
        '#FF5733', '#33FF57', '#3357FF', '#F0E442', '#8A2BE2', '#FF1493', '#20B2AA', '#FFD700', '#B22222', '#7FFF00'
    ];

    // วนลูปดึงข้อมูลเฉพาะรอบล่าสุด
    var latestRound = Object.keys(results).pop(); // หารอบล่าสุด (round2 / round1)
    if (latestRound) {
        Object.entries(results[latestRound]).forEach(([groupName, data], index) => {
            groupNames.push(groupName);
            avgScores.push(parseFloat(data.AverageTotalScoreGroupByUser));
            colors.push(colorPalette[index % colorPalette.length]); // กำหนดสีให้กลุ่มตามลำดับ
        });
    }

    var options = {
        series: [{
            name: "คะแนนเฉลี่ย",
            data: avgScores
        }],
        chart: {
            type: 'bar',
            height: 800
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: true
        },
        colors: colors, // ใช้สีที่กำหนดให้กับกราฟ
        xaxis: {
            categories: groupNames, // ใช้ชื่อกลุ่มเป็น label
            title: {
                text: "คะแนนเฉลี่ย"
            }
        },
        yaxis: {
            title: {
                text: "กลุ่ม"
            }
        },
        title: {
            text: `คะแนนเฉลี่ยของแต่ละกลุ่ม (${latestRound})`,
            align: 'center'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
