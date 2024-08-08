
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php
    $setting = \App\Models\Utility::settings();
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<style>
    @media (min-width: 1400px) {
    .mycal {
        height: 570px !important;
    }
}
</style>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://hammerjs.github.io/dist/hammer.js"></script>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
     $(document).ready(function()
      {
    var data =  '<?php echo e($findremind); ?>'; 
    console.log("sdf"+data)
      if(data != '') 
      {
      var id = '<?php echo e(!empty($findremind)?$findremind->id:''); ?>';     
      Swal.fire({
      title: '<?php echo e(!empty($findremind)?$findremind->name:''); ?>'+'?',
      text: '<?php echo e(!empty($findremind)?$findremind->description:''); ?>'+'!',
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, read it!"
    }).then((result) => {
          if (result.isConfirmed) {
                var url = '<?php echo e(route('reminder.read')); ?>'
                   $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                           
                            'id': id,
                            
                            'session_key': session_key,
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if(data.is_success == true){
                               Swal.fire({
                              title: "Read!",
                              text: "Your has been seen the reminder.",
                              icon: "success"
                            });  
                            }else{
                                Swal.fire({
                              title: "fieled!",
                              text: "fieled.",
                              icon: "error"
                            });
                                
                            }
                           
                            
                            }
                        
                           
                           
                    });
           
          }
        });
      }
    });
   
    </script>
    <script type="text/javascript">
    $(document).ready(function()
    {
    // Remove the class after 5 seconds (5000 milliseconds) as an example
    setTimeout(function() {
        $('#calendar').children('div').addClass('d-xxl-block');
    }, 3000);

    $("#toggle-goals").click(function () {
        $("#calender2").toggle();
        $("#calender-goals").toggle();
        $(".ti-list").toggle();
        $(".ti-calendar").toggle();
});


    });

</script>

    <script type="text/javascript">

        $(document).ready(function()
        {
            get_data();
        });
        function get_data()
        {
            var calender_type=$('#calender_type :selected').val();
            $('#calendar').removeClass('local_calender');
            $('#calendar').removeClass('goggle_calender');
            if(calender_type==undefined){
                $('#calendar').addClass('local_calender');
            }
            $('#calendar').addClass(calender_type);
            $.ajax({
                url: $("#task_calendar").val()+"/calendar/reminder" ,

                method:"POST",
                data: {"_token": "<?php echo e(csrf_token()); ?>",'calender_type':calender_type},
                success: function(data) {
                    // console.log(data);
                    (function() {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                        });

                        calendar.render();
                    })();
                }
            });
        }
    </script>
<script>
(() => {
  // Respect user perference
  const isReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
  ).matches;

  // Helper to apply inline CSS
  const setStyleProps = ($el, styles) => {
    for (const [key, value] of Object.entries(styles)) {
      if (value === false) {
        $el.style.removeProperty(key);
      } else {
        $el.style.setProperty(key, value);
      }
    }
  };

  document.querySelectorAll('.Carousel').forEach(($carousel) => {
    $carousel.scrollLeft = 0;

    const $cards = Array.from($carousel.querySelectorAll('.Card'));
    const $pagination = $carousel.nextElementSibling;
    const [$previous, $next] = $pagination.querySelectorAll('.Arrow');
    // $pagination.querySelector('.Dot').classList.add('Dot--active');

    const $start = document.createElement('div');
    const $end = document.createElement('div');
    $carousel.prepend($start);
    $carousel.append($end);

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.target === $start) {
          if ($previous) {
            $previous.disabled = entry.isIntersecting;
          }
        }
        if (entry.target === $end) {
          if ($next) {
            $next.disabled = entry.isIntersecting;
          }
        }
      });
    });
    observer.observe($start);
    observer.observe($end);

    const scrollTo = ($card) => {
      let offset = getOffset($card);
      const left = document.dir === 'rtl' ? -offset : offset;
      const behavior = isReducedMotion ? 'auto' : 'smooth';
      $carousel.scrollTo({left, behavior});
    };

    const getOffset = ($el) => {
      let offset = $el.offsetLeft;
      if (document.dir === 'rtl') {
        offset = $carousel.offsetWidth - (offset + $el.offsetWidth);
      }
      return offset;
    };

    $previous.addEventListener('click', (ev) => {
      ev.preventDefault();
      let $card = $cards[0];
      const scroll = Math.abs($carousel.scrollLeft);
      $cards.forEach(($item) => {
        const offset = getOffset($item);
        if (offset - scroll < -1 && offset > getOffset($card)) {
          $card = $item;
        }
      });
      scrollTo($card);
    });

    $next.addEventListener('click', (ev) => {
      ev.preventDefault();
      let $card = $cards[$cards.length - 1];
      const scroll = Math.abs($carousel.scrollLeft);
      $cards.forEach(($item) => {
        const offset = getOffset($item);
        if (offset - scroll > 1 && offset < getOffset($card)) {
          $card = $item;
        }
      });
      scrollTo($card);
    });

    $pagination.addEventListener('click', (ev) => {
      if (ev.target.classList.contains('Dot')) {
        ev.preventDefault();
        const $card = document.querySelector(new URL(ev.target.href).hash);
        if ($card) scrollTo($card);
      }
    });

    // Highlight nearest "Dot" in pagination
    let scrollTimeout;
    $carousel.addEventListener(
      'scroll',
      () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
          let $dot = $pagination.querySelector('.Dot--active');
          if ($dot) $dot.classList.remove('Dot--active');
          let $active;
          const scroll = Math.abs($carousel.scrollLeft);
          if (scroll <= 0) {
            $active = $cards[0];
          }
          if (scroll >= $carousel.scrollWidth - $carousel.offsetWidth) {
            $active = $cards[$cards.length - 1];
          }
          if (!$active) {
            let oldDiff;
            $cards.forEach(($card) => {
              const newDiff = Math.abs(scroll - getOffset($card));
              if (!$active || newDiff < oldDiff) {
                $active = $card;
                oldDiff = newDiff;
              }
            });
          }
          $dot = $pagination.querySelector(
            `[href="#${($active ?? $card[0]).id}"]`
          );
          if ($dot) $dot.classList.add('Dot--active');
        }, 50);
      },
      {passive: true}
    );

    // Improve arrow key navigation
    $carousel.addEventListener('keydown', (ev) => {
      if (/^(Arrow)?Left$/.test(ev.key)) {
        ev.preventDefault();
        (document.dir === 'rtl' ? $next : $previous).click();
      } else if (/(Arrow)?Right$/.test(ev.key)) {
        ev.preventDefault();
        (document.dir === 'rtl' ? $previous : $next).click();
      }
    });

    // Improve transition when tabbing focus

    let scrollLeft = 0;
    $carousel.addEventListener(
      'blur',
      (ev) => {
        scrollLeft = $carousel.scrollLeft;
      },
      {capture: true}
    );
    $carousel.addEventListener(
      'focus',
      (ev) => {
        $carousel.scrollLeft = scrollLeft;
        const $card = ev.target.closest('.Card');
        if ($card) scrollTo($card);
      },
      {capture: true}
    );
  });

  // Optional polyfill for Safari 14
  if (!isReducedMotion && !window.CSS.supports('scroll-behavior: smooth')) {
    import('https://cdn.skypack.dev/smoothscroll-polyfill').then((module) => {
      module.polyfill();
    });
  }
})();

(() => {
  // Toggle right-to-left for demo
  document.querySelector('#toggle-rtl').addEventListener('change', (ev) => {
    document.dir = ev.target.checked ? 'rtl' : 'ltr';
    document.querySelectorAll('.Carousel').forEach(($carousel) => {
      $carousel.scrollLeft = 0;
    });
  });

  // Toggle single slides class for demo
  document.querySelector('#toggle-single').addEventListener('change', (ev) => {
    document.querySelectorAll('.Carousel').forEach(($carousel) => {
      $carousel.classList.toggle('Carousel--single', ev.target.checked);
    });
  });
})();
</script>
    <script>
        <?php if(\Auth::user()->can('show account dashboard')): ?>
       
        
        (function () {
          
            // var chartBarOptions = {
            //     series: [
            //         {
            //             name: "<?php echo e(__('Income')); ?>",
            //             data:<?php echo json_encode($incExpLineChartData['income']); ?>

            //         },
            //         {
            //             name: "<?php echo e(__('Expense ,To do')); ?>",

            //             data: <?php echo json_encode($incExpLineChartData['expense']); ?>

            //         }
            //     ],

        var options = {
          series: <?php echo json_encode($incTotalMan); ?>,
          chart: {
          height: 350,
          type: 'radialBar',
          offsetY: -10
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: {
                fontSize: '16px',
                color: '#ff5000',
                offsetY: 120
              },
              value: {
                offsetY: 0,
                fontSize: '22px',
                color: undefined,
                formatter: function (val) {
                  return val + "%";
                }
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
              shade: '#ff5000',
              shadeIntensity: 0.15,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91],
               color: '#ff5000',
          },
        },
        stroke: {
          dashArray: 4
         
        },
        labels: ['Task Complete'],
        };
        var chart = new ApexCharts(document.querySelector("#cash-flow"), options);
        chart.render();
           
        })();

        (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "<?php echo e(__('Income')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('Expense')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
                },
                colors: ['#3ec9d6', '#FF3A6E'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incExpBarChart"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($expenseCatAmount); ?>,
                colors: <?php echo json_encode($expenseCategoryColor); ?>,
                labels: <?php echo json_encode($expenseCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#expenseByCategory"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($incomeCatAmount); ?>,
                colors: <?php echo json_encode($incomeCategoryColor); ?>,
                labels:  <?php echo json_encode($incomeCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#incomeByCategory"), options);
            chart.render();
        })();

        (function () {
            var options = {
                series: [<?php echo e(round($storage_limit,2)); ?>],
                chart: {
                    height: 350,
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#e7e7e7",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                        },
                        dataLabels: {
                            name: {
                                show: true
                            },
                            value: {
                                offsetY: -50,
                                fontSize: '20px'
                            }
                        }
                    }
                },
                grid: {
                    padding: {
                        top: -10
                    }
                },
                colors: ["#6FD943"],
                labels: ['Used'],
            };
            var chart = new ApexCharts(document.querySelector("#limit-chart"), options);
            chart.render();
        })();
        (function () {
    var options = {
        series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
        chart: {
            type: 'polarArea',
        },
        colors: ['#FF5733', '#FFC300', '#36A2EB', '#4CAF50', '#FF6384', '#8e5ea2', '#3cba9f', '#e8c3b9', '#c45850'],
        fill: {
            opacity: 1, // Adjust opacity for more vibrant colors
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
    chart.render();
})();




    (function () {
  
var options = {
    series: [{
        data: <?php echo json_encode($deadqty); ?>,
    }],
    chart: {
        type: 'bar',
        height: 200, // Increase the chart height for better spacing
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: false,
            colors: {
                backgroundBarColors: ['#E8F0FF'],
                ranges: [{
                    from: 0,
                    to: 10000,
                    color: 'orangered' // Set the color of bars to orangered
                }]
            }
        }
    },
    dataLabels: {
        enabled: true,
                useHTML: true, // Allow HTML content in data labels

        formatter: function(val) {
            return val + "%"; // Use Unicode newline character (\n) for line break
        },
        offsetY: -15 // Adjust the vertical offset of the data labels
    },
    tooltip: {
        enabled: true,
        shared: true,
        intersect: false,
        y: {
            formatter: function (val) {
                return val + "% left";// Tooltip formatter remains the same as the data already contains the required format
            }
        }
    },
    yaxis: {
        show: true // Disable y-axis name
    },
    xaxis: {
        labels: {
            show: true, // Hide x-axis labels
        },
        categories: <?php echo json_encode($materialName); ?>,
        position: 'bottom'
    }
};

var chart = new ApexCharts(document.querySelector("#bar_chart"), options);
chart.render();

$("#bar_chart").css({
    "width": "300px",
    "overflow-x": "scroll",
    "height": "250px" // Adjust height as needed
});
//   overflow-x: scroll;
//     overflow-y: hidden;
//     width: 300px;
})();
 
(function () {
    var options = {
        series: [{
            data: [44, 55, 41, 64, 22, 43, 21],
            color: 'orangered'
        }, {
            data: [53, 32, 33, 52, 13, 44, 32]
        }],
        chart: {
            type: 'bar',
            height: 430
        },
        plotOptions: {
            bar: {
                horizontal: false,
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            offsetX: -6,
            style: {
                fontSize: '12px',
                colors: ['#fff']
            }
        },
        stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        xaxis: {
            categories: ['December', 'January', 'February', 'March', 'April', 'May', 'June'],
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value > 1000 ? (value / 1000).toFixed(0) + 'k' : value;
                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                    fontWeight: 400,
                    color: '#333'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#pendingpaymentchart"), options);
    chart.render();
})();

        

        <?php endif; ?>
 
    </script>
    <script>

let currentInd = '<?php echo \Carbon\Carbon::now()->format('d'); ?>';
let currentIndex =7;
 const date = new Date();
        const formattedDates = date.toLocaleString('en-US', { weekday: 'short', day: '2-digit' });
        // alert(formattedDates)
// Function to generate date labels for the next 7 days
function updateCalendarHeading() {
    const calenderHead = document.getElementById('task_calender_heading');
    const currentDate = new Date();
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const month = monthNames[currentDate.getMonth()];
    const year = currentDate.getFullYear();

    calenderHead.textContent = `${month},${year}`;
}

// Call the function to update the calendar heading initially
updateCalendarHeading();
function generateDateLabels() {
    const currentDate = new Date();
    const labels = [];
    for (let i = -7; i <= 7; i++) {
        const date = new Date(currentDate);
        date.setDate(date.getDate() + i);
        labels.push(formatDate(date));
    }
    return labels;
}

// Function to format a date object into a string like "April 20, 2024"
function formatDate(date) {
    return `${date.toLocaleString('default', { month: 'long' })} ${date.getDate()}, ${date.getFullYear()}`;
}

// Generate date labels for the next 7 days
const dateLabels = generateDateLabels();

// Function to create date cards in the carousel
function createDateCards() {
    const dateSliderCards = document.getElementById("date-slider-cards");
    dateSliderCards.innerHTML = ''; // Clear existing cards

    dateLabels.forEach((label, index) => {
        const cardItem = document.createElement('div');
        cardItem.classList.add('card-item');
        const date = new Date(label);
        const formattedDate = date.toLocaleString('en-US', { weekday: 'short', day: '2-digit' });
        console.log(formattedDate)
        cardItem.textContent = formattedDate;
        if(formattedDates === formattedDate){
          cardItem.classList.add('bg-danger'); 
           cardItem.classList.add('text-light'); 
        }
        //   alert(index)
        //      alert(currentIndex)
        if (index === currentIndex) {
           
            cardItem.classList.add('active');
        }
        dateSliderCards.appendChild(cardItem);
    });
  console.log("list"+dateSliderCards)
    // Scroll the slider container to center the selected date card
    const selectedCard = dateSliderCards.querySelector('.active');
  
    if (selectedCard) {
        const cardWidth = selectedCard.offsetWidth;
        const scrollLeft = (selectedCard.offsetLeft + cardWidth / 2) - dateSliderCards.offsetWidth / 2;
        dateSliderCards.scrollLeft = scrollLeft;
    }
}

// Function to slide date cards when left or right arrows are clicked
function slideCards(direction) {
    $("#reminderModal").show()
    const maxIndex = dateLabels.length - 1;
    currentIndex = (currentIndex + direction) % dateLabels.length;
    if (currentIndex < 0) {
        currentIndex = maxIndex;
    }
    document.getElementById("date-label").textContent = dateLabels[currentIndex];
    createDateCards();
}

// Initial setup
createDateCards();


    </script>

    <script>
//         const $ = (selector) => {
//   return document.querySelector(selector);
// };

function next() {
 
  if ($(".hide")) {
    $(".hide").remove();
  }

  /* Step */

  if ($(".prev-calender-dashboard")) {
    $(".prev-calender-dashboard").classList.add("hide");
    $(".prev-calender-dashboard").classList.remove("prev-calender-dashboard");
  }

  $(".act-calender-dashboard").classList.add("prev-calender-dashboard");
  $(".act-calender-dashboard").classList.remove("act-calender-dashboard");

  $(".next-calender-dashboard").classList.add("act-calender-dashboard");
  $(".next-calender-dashboard").classList.remove("next-calender-dashboard");

  /* New Next */

  $(".new-next").classList.remove("new-next");

  const addedEl = document.createElement("li");

  $(".list-calender-dashboard").appendChild(addedEl);
  addedEl.classList.add("next-calender-dashboard", "new-next");
}

function prev() {
  $(".new-next").remove();

  /* Step */

  $(".next-calender-dashboard").classList.add("new-next");

  $(".act-calender-dashboard").classList.add("next-calender-dashboard");
  $(".act-calender-dashboard").classList.remove("act-calender-dashboard");

  $(".prev-calender-dashboard").classList.add("act-calender-dashboard");
  $(".prev-calender-dashboard").classList.remove("prev-calender-dashboard");

  /* New Prev */

  $(".hide").classList.add("prev-calender-dashboard");
  $(".hide").classList.remove("hide");

  const addedEl = document.createElement("li");

  $(".list-calender-dashboard").insertBefore(addedEl, $(".list-calender-dashboard").firstChild);
  addedEl.classList.add("hide");
}

slide = (element) => {
  /* Next slide */

  if (element.classList.contains("next-calender-dashboard")) {
 
    next();

    /* Previous slide */
  } else if (element.classList.contains("prev-calender-dashboard")) {
    
    prev();
  }
};

const slider = $(".list-calender-dashboard"),
  swipe = new Hammer($(".swipe-calender-dashboard"));

slider.onclick = (event) => {
  
  slide(event.target);
};

swipe.on("swipeleft", (ev) => {
  next();
});

swipe.on("swiperight", (ev) => {
  prev();
});

    </script>
    <script>
        function selectFilter(element){
            document.querySelectorAll('.filter-calender').forEach(item =>{
                item.classList.remove('active-filtered')
            })
            element.classList.add('active-filtered')
        }
    </script>
    <script>
    $( document ).ready(function() {
   $("#reminderModal").hide()
});
    </script>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Overview')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <?php if(\Auth::user()->type != 'company'): ?>
<?php
$date = \Carbon\Carbon::now()->format('Y-m-d');



?>
<?php endif; ?>
    <div class="row dashboard-header-row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-7">
                  
                    <div class="row">
                        <div class="col-md-12 inner-dashboard-content" style="height:400px;">
                              <h4>Overview</h4>
                                <span>Last 1 Months</span>
                            <div class="row mt-3">
                                <div class="col-lg-3 col-6">
                                    <div class="card INR-card-accountdashboard">
                                        <div class="card-body">
                                            <div class="theme-avtar  bg-INR-accountdashboard">
                                                  <img class="" src="<?php echo e(asset('assets/images/dashboard/customer-icon.png')); ?>" alt="" style="height: 50px;">
                                            </div>
                                            <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'sales'): ?>
                                            <h3 class="mb-0 mt-3"><?php echo e($quote[0]->amount != ''?round($quote[0]->amount, 0):0.00); ?></h3>
                                            <span class="percent-heading">+<?php echo e(round($per, 2)); ?>% </br>from yesterday</span>
                                            <?php else: ?>
                                             <h3 class="mb-0 mt-3">0.00</h3>
                                            <span class="percent-heading">+ 0% from yesterday</span>
                                             <?php endif; ?>

                                            <p class="text-lg mt-4 mb-2 font-weight-600"><?php echo e(__('Total')); ?> <br> <?php echo e(__('Vendor')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card customer-card-accountdashboard">
                                        <div class="card-body rounded-circle">
                                            <div class="theme-avtar   bg-INR-accountdashboard">
                                                  <img src="<?php echo e(asset('assets/images/dashboard/order-request-icon.svg')); ?>" alt="" style="height: 30px;">
                                            </div>
                                            <h3 class="mb-0 mt-3"><?php echo e(\Auth::user()->countConvertedCustomers()); ?></h3>
                                              <span class="percent-heading">+<?php echo e(round($customerPer,2)); ?>% </br>from yesterday</span>
                                            <p class="text-lg mt-4 mb-2 font-weight-600"><?php echo e(__('Order')); ?> <br> <?php echo e(__('Request')); ?></p>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card order-card-accountdashboard">
                                        <div class="card-body">
                                            <div class="theme-avtar rounded-circle bg-order-accountdashboard">
                                                   <img src="<?php echo e(asset('assets/images/dashboard/purchase-order-icon.svg')); ?>" alt="" style="height: 30px;">
                                            </div>
                                              <h3 class="mb-0 mt-3"><?php echo e($createdOrders); ?></h3>
                                                <span class="percent-heading">+<?php echo e(round($orderPer,2)); ?>% </br>from yesterday</span>
                                            <p class="text-lg mt-4 mb-2 font-weight-600"><?php echo e(__('Purchase')); ?> <br> <?php echo e(__('Order')); ?></p>
                                          
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-6">
                                    <div class="card invoice-card-accountdashboard">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-info">
                                                    <img src="<?php echo e(asset('assets/images/dashboard/invoice-icon.png')); ?>" alt="" style="height: 50px;">
                                            </div>
                                             <h3 class="mb-0 mt-3"><?php echo e(\Auth::user()->countInvoices()); ?> </h3>
                                                                                         <span class="percent-heading">0.5% </br>from yesterday</span>

                                            <p class="text-lg mt-4 mb-2 font-weight-600"><?php echo e(__('Return')); ?> <br> <?php echo e(__('Order')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xxl-12 mt-5 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Income & Expense')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Current Year').' - '.$currentYear); ?></span>
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div id="incExpBarChart"></div>
                                </div>
                            </div>
                        </div>
                        
                  
                        
                            
                        
                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Latest Expense')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Vendor')); ?></th>
                                                <th><?php echo e(__('Amount Due')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $latestExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                <tr>
                                                    <td><?php echo e(\Auth::user()->dateFormat($expense->date)); ?></td>
                                                    <td><?php echo e(!empty($expense->vender)?$expense->vender->name:'-'); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($expense->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('There is no latest expense')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Recent Invoices')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo e(__('Customer')); ?></th>
                                                <th><?php echo e(__('Issue Date')); ?></th>
                                                <th><?php echo e(__('Due Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $recentInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></td>
                                                    <td><?php echo e(!empty($invoice->customer_name)? $invoice->customer_name:''); ?> </td>
                                                    <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                                    <td><?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                                    <td>
                                                        <?php if($invoice->status == 0): ?>
                                                            <span class="p-2 px-3 rounded badge status_badge bg-secondary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 1): ?>
                                                            <span class="p-2 px-3 rounded badge status_badge bg-warning"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 2): ?>
                                                            <span class="p-2 px-3 rounded badge status_badge bg-danger"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 3): ?>
                                                            <span class="p-2 px-3 rounded badge status_badge bg-info"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 4): ?>
                                                            <span class="p-2 px-3 rounded badge status_badge bg-primary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('There is no recent invoice')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Recent Bills')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo e(__('Vendor')); ?></th>
                                                <th><?php echo e(__('Bill Date')); ?></th>
                                                <th><?php echo e(__('Due Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $recentBill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                                    <td><?php echo e(!empty($bill->vender_name)? $bill->vender_name : '-'); ?> </td>
                                                    <td><?php echo e(Auth::user()->dateFormat($bill->bill_date)); ?></td>
                                                    <td><?php echo e(Auth::user()->dateFormat($bill->due_date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($bill->getTotal())); ?></td>
                                                    <td>
                                                        <?php if($bill->status == 0): ?>
                                                            <span class="p-2 px-3 rounded badge bg-secondary"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 1): ?>
                                                            <span class="p-2 px-3 rounded badge bg-warning"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 2): ?>
                                                            <span class="p-2 px-3 rounded badge bg-danger"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 3): ?>
                                                            <span class="p-2 px-3 rounded badge bg-info"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 4): ?>
                                                            <span class="p-2 px-3 rounded badge bg-primary"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('There is no recent bill')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                          
                    
                    
                      
                            
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="height:400px;">
                                <div class="card-header">
                                    <h4 class="mt-1 mb-0"><?php echo e(__('Total Order Request')); ?></h4>
                                    <p class="mt-2">Last 1 Months</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mt-2">
                                              <h1><?php echo e(sprintf("%02d", $totalManOrder)); ?></h1>
                                              <span>Total Order Requests</span>
                                              <div class="mt-2">
                                              <span class="h-1 w-1  m-1 px-2 rounded-circle " style="background:#DF7C7C;"></span>

                                               <?php echo e($lastMonth_pendingOrder); ?> Request Pending
                                            </div>
                                             
                                              <div class="mt-2">
                                              <span class="h-1 w-1  m-1 px-2 rounded-circle " style="background:#2EAF2B;"></span>

                                                <?php echo e($lastMonth_completeOrder); ?> Request Completed
                                            </div>
                                            </div>
                                        </div>
                                 <div class="col-6">
                                    <div class="image-container">
                                        <img src="<?php echo e(asset('assets/images/dashboard/progress-bar.png')); ?>" alt="" class="img-fluid">
                                        <div class="centered-text">
                                            <h3><?php echo e(($lastMonth_completeOrder/$totalManOrder) * 100); ?>%</h3>
                                            <h3 style="font-size: 15px;font-weight: normal;">Task Complete</h3>
                                        </div>
                                    </div>
                                </div>

                                    </div>
                                   
                 
                                      
                            
                                </div>
                            </div>
                            



                           
                        </div>
                        

                          
                        </div>
                        




                        
                            <div class="card d-none">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Income Vs Expense')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Income Today')); ?></p>
                                                    <h4 class="mb-0 text-primary"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayIncome())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-file-invoice"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Expense Today')); ?></p>
                                                    <h4 class="mb-0 text-info"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayExpense())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Income This Month')); ?></p>
                                                        <h4 class="mb-0 text-warning"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->incomeCurrentMonth())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-file-invoice"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Expense This Month')); ?></p>
                                                    <h4 class="mb-0 text-danger"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->expenseCurrentMonth())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                            <div class="row mt-3">
                                     
          <div class="col-md-8"> 
          <div class="card" style="height: 572px;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                    <h4 class="mt-1 mb-0"><?php echo e(__('Total Order by Priorities')); ?></h4>
                                    <div class="view-button-accountdashboard">
                                      <span><i class='bx bxs-circle' style='color:#FF5000'  ></i> High Priority</span>  
                                      <span><i class='bx bxs-circle' style="color: #00E096;"></i> Low Priority</span>  
                                    </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="pendingpaymentchart">
                                   
                                    </div>
                                </div>
                            </div>
                               </div>
                         <div class="col-md-4 ">
                            <div class="card" style="height: 516px;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mt-1 mb-0"><?php echo e(__('Recent Alerts')); ?></h4>
                                        <div class="view-button-accountdashboard">
                                            <button>view</button>
                                           
                                                <i class='bx bx-chevron-right side-arrow-view-dashboard'></i>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-center gap-2">
                                       <div class="recent-alerts-section-1">
                                        <h5><i class='bx bxs-circle'></i> Low Raw Materials</h5>
                                         <p>Increase Material Stock </p>
                                         <small><?php echo e(\Carbon\Carbon::now()->format("H:i A D, d M Y")); ?></small>
                                       </div>

                                       <div class="recent-alerts-section-2">
                                        <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($m->current_qty - $m->used_qty <= 5): ?>
                                        <h5><i class='bx bxs-circle'></i>
                                        <?php echo e($m->current_qty - $m->used_qty <= 5? $m->material_name: ''); ?> , Stock: <?php echo e($m->current_qty - $m->used_qty); ?></h5>
                                      
                                         <small><?php echo e(\Carbon\Carbon::now()->format("H:i A D, d M Y")); ?> </small>
                                         <?php endif; ?>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </div>
                                    </div>
                                </div>
                            </div>
                      </div>

                      
                    </div>

                
                    <div class="row">
                         <div class="col-xxl-5">
                            <div class="card" style="height: 572px;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                    <h4 class="mt-1 mb-0"><?php echo e(__('Total Order')); ?></h4>
                                    <div class="view-button-accountdashboard">
                                      <span><i class='bx bxs-circle' style='color:#FF5000'  ></i> Return Orders </span>  
                                      <span><i class='bx bxs-circle' style="color: #00E096;"></i> Purchase Orders</span>  
                                    </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="pendingpaymentchart">
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-xxl-3 ">
                          <div class="card" style="height: 572px;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between gap-2 todo-list-section-dashboard">
                                            <img src="<?php echo e(asset('assets/images/dashboard/ToDoDashboard.png')); ?>" alt="Todo">
                                            <h4  class="mt-1 mb-0"><?php echo e(('To do')); ?></h4>
                                        </div>
                                        <div class="addnew-button-accountdashboard">
                                         
                                            <a href="#" data-url="<?php echo e(route('todos.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create ToDo')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary"> <i class='bx bx-plus plus-icon-addnew-dashboard text-light' style="border: 1px solid #ffffff;"></i> Add new</a>                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-center gap-2">
                                       <div class="todo-list-dashboard-content">
                                       <ul>
                                         <?php $__currentLoopData = $todo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                        <li><?php echo e($t->name); ?> <?php echo e($t->description); ?> <?php echo e(\Auth::user()->dateFormat($t->created_at)); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </ul>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                              </div>
                              
                        <div  class="col-xxl-4">
                        <div class="card mycal">
   
                        <div class="card-body pt-0   " >
                        <div style="position:sticky;top:10px;z-index:1000; " class="icon-container  d-xxl-flex  d-flex justify-content-end">
                        <button id="toggle-goals" class="btn btn-warning py-1 my-1" style="margin-right:-112px;">
                            <i class="ti ti-list" style="display:block;"></i>
                            <i class="ti ti-calendar " style="display:none;"></i> <!-- Use the appropriate icon class -->
                        </button>
                    </div>


                        <div class="row" >
                        <div class="col-xxl-12 " >
                            <div id="calender2" style="display:block;" class="card   ">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5><?php echo e(__('Reminder Calendar')); ?></h5>
                                        </div>
                                        <div class="col-lg-6" style="text-align: end;">
                                            <?php if(isset($setting['google_calendar_enable']) && $setting['google_calendar_enable'] == 'on'): ?>
                                                <select class="form-control" name="calender_type" id="calender_type" onchange="get_data()">
                                                    <option value="goggle_calender"><?php echo e(__('Google Calender')); ?></option>
                                                    <option value="local_calender" selected="true"><?php echo e(__('Local Calender')); ?></option>
                                                </select>
                                            <?php endif; ?>
                                            <input type="hidden" id="task_calendar" value="<?php echo e(url('/')); ?>">
                                              <a href="#" data-url="<?php echo e(route('reminder.index')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Reminder')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Reminder')); ?>"  class="btn btn-sm btn-primary">
                                               <i class='ti ti-plus'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="height:;padding: 0;">
                                    <div id='calendar' class='calendar'></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 ">
                            <div id="calender-goals" class="card " style="display:none;" >
                                <div class="card-body task-calendar-scroll" style="height:515px;">
                                    <h4 class="mb-4"><?php echo e(__('Reminder')); ?></h4>
                                    <ul class="event-cards list-group list-group-flush mt-3">
                                        <?php $__empty_1 = true; $__currentLoopData = $remind; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-calendar-event"></i>
                                                            </div>
                                                            <div class="ms-3 fc-event-title-container">
                                                                <h6 class="m-0 text-sm fc-event-title text-primary"><?php echo e($r['name']); ?> 
                                                                <?php if($r['is_read'] == 1): ?>
                                                                <i class="ti ti-circle-check text-success"></i>
                                                                <?php endif; ?>
                                                                </h6>
                                                                <small class="text-muted"><?php echo e($r['description']); ?></small></br>
                                                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($r['created_at'])->diffForHumans()); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <p class="text-dark text-center"><?php echo e(__('No Data Found')); ?></p>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                                  
                    </div>
                        </div>
                                
                    </div>    
                              
                       



                        
                    </div>

                    
                        
                    

                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Storage Limit')); ?>


                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="limit-chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Income By Category')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Year').' - '.$currentYear); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="incomeByCategory"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Expense By Category')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Year').' - '.$currentYear); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="expenseByCategory"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#invoice_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Invoices Weekly Statistics')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#invoice_monthly_statistics" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Invoices Monthly Statistics')); ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="invoice_weekly_statistics" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoicePaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="invoice_monthly_statistics" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoicePaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 d-none">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#bills_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Bills Weekly Statistics')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#bills_monthly_statistics" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Bills Monthly Statistics')); ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="bills_weekly_statistics" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billPaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bills_monthly_statistics" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billPaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Goal')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $total= $goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['total'];
                                    $percentage=$goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'];
                                    $per=number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '');
                                ?>
                                <div class="card border-success border-2 border-bottom-0 border-start-0 border-end-0">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <label class="form-check-label d-block" for="customCheckdef1">
                                                <span>
                                                    <span class="row align-items-center">
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Name')); ?></span>
                                                            <h6 class="text-nowrap mb-3 mb-sm-0"><?php echo e($goal->name); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Type')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e(__(\App\Models\Goal::$goalType[$goal->type])); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Duration')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e($goal->from .' To '.$goal->to); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Target')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e(\Auth::user()->priceFormat($total).' of '. \Auth::user()->priceFormat($goal->amount)); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Progress')); ?></span>
                                                            <h6 class="mb-2 d-block"><?php echo e(number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '')); ?>%</h6>
                                                            <div class="progress mb-0">
                                                                <?php if($per<=33): ?>
                                                                    <div class="progress-bar bg-danger" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php elseif($per>=33 && $per<=66): ?>
                                                                    <div class="progress-bar bg-warning" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php else: ?>
                                                                    <div class="progress-bar bg-primary" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card pb-0">
                                    <div class="card-body text-center">
                                        <h6><?php echo e(__('There is no goal.')); ?></h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        if(window.innerWidth <= 500)
        {
            $('p').removeClass('text-sm');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/dashboard/purchase-management-dashboard.blade.php ENDPATH**/ ?>