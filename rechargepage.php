<?php
include "config.php";
session_start();

if(isset($_SESSION["page"])){
    unset($_SESSION["page"]);
}

if (isset($_SESSION["channels"])) {
    unset($_SESSION["channels"]);
    unset($_SESSION["total_amount"]);
}

if ($_SESSION["vc_id"]) {
    $sql = "SELECT p.*, GROUP_CONCAT(c.channel_name SEPARATOR ', ') AS channel_names
            FROM `packs` p
            LEFT JOIN `all_channels` c ON FIND_IN_SET(c.channel_id, p.channels) > 0
            WHERE p.`pack_type` IN ('broadcast', 'channels')
            GROUP BY p.pack_id;";

    $sql .= "SELECT * FROM `all_channels`;";

    if ($conn->multi_query($sql)) {
        $result = $conn->store_result();
        $conn->next_result();
        $allChannelsResult = $conn->store_result();

        $data = [
            'broadcast_packs' => [],
            'channels_pack' => [],
            'all_channels' => [],
            'base_price' => 0,
        ];

        while ($row = $result->fetch_assoc()) {
            $row['channels'] = explode(', ', $row['channel_names']);
            unset($row['channel_names']);

            if ($row['pack_type'] == 'broadcast') {
                $data['broadcast_packs'][] = $row;
            } else {
                $data['channels_pack'][] = $row;
            }
        }

        while ($row = $allChannelsResult->fetch_assoc()) {
            $data['all_channels'][] = $row;
        }

        $sql = "SELECT `base_price` FROM `static_details`";
        $result2 = $conn->query($sql);
        $b = $result2->fetch_assoc();
        $data['base_price'] = $b["base_price"];

        $json_data = json_encode($data);
    }

    $conn->close();
} else {
    header("location:login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recharge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="adminlte.min.css">
</head>

<body>
    <div class="text-center my-3">
        <h3>Recharge Plans</h3>
    </div>

    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs justify-content-center" id="recharge" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="broadcast-pack-tab" data-toggle="pill" href="#broadcast-pack" role="tab"
                            aria-controls="broadcast-pack" aria-selected="true">Broadcaster Packs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="channel-packs-tab" data-toggle="pill" href="#channel-packs" role="tab"
                            aria-controls="channel-packs" aria-selected="false">Channels Pack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="all-channels-tab" data-toggle="pill" href="#all-channels" role="tab"
                            aria-controls="all-channels" aria-selected="false">All Channels</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="recharge-category">
                    <div class="tab-pane fade" id="broadcast-pack" role="tabpanel" aria-labelledby="broadcast-pack-tab">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Broadcaster Table</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="search" name="table_search" oninput="broadcastSearch()" id="broadcastSearchInput" class="form-control float-right"
                                                    placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap" id="broadcastTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Channels</th>
                                                    <th>Recharge</th>
                                                </tr>
                                            </thead>
                                            <tbody id="broadcastTableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="channel-packs" role="tabpanel" aria-labelledby="channel-packs-tab">
                        <div class="row">
                        <div class="col-12">
                        <div class="card">
                                    <div class="card-header">
                                    <div class="text-center">
                                        <button type="submit" id="channelsPackButton" class="btn btn-dark">Recharge</button>
                                    </div>
                                        <h3 class="card-title">Channels Pack Table</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="search" name="table_search" oninput="channelsPackSearch()" id="channelsPackSearchInput" class="form-control float-right"
                                                    placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <form action="alacartesumup.php" method="post" id="channelsPackForm">
                                            <table class="table table-hover text-nowrap" id="channelsPackTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Channels</th>
                                                        <th>Select Pack</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="channelsPackTableBody">
                                                    <input type="hidden" name="type" value="channelsPack">
                                                </tbody>
                                            </table>
                                        </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="all-channels" role="tabpanel" aria-labelledby="all-channels-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                
                                    <div class="card-header">
                                        <div class="text-center">
                                            <button type="submit" id="allchannelsPackButton" class="btn btn-dark">Recharge</button>
                                        </div>
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="search" oninput="allChannelsSearch()" id="allChannelsSearchInput" name="table_search" class="form-control float-right"
                                                    placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-default" onClick="allChannelsSearch()">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <form method="post" id="allchannelsPackForm" action="alacartesumup.php">
                                            <table class="table table-hover text-nowrap" id="allChannelsTable">
                                                <thead>
                                                    <tr>
                                                        <th>Channel Name</th>
                                                        <th>Price</th>
                                                        <th>Add</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="allChannelsTableBody">
                                                    <input type="hidden" name="type" value="allChannels">
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var cachedData = <?php echo $json_data; ?> || {};
        var broadcastTableBody = document.getElementById("broadcastTableBody");
        var channelsPackTableBody = document.getElementById("channelsPackTableBody");
        var allChannelsTableBody = document.getElementById("allChannelsTableBody");

        
        // Populate Broadcast Packs Table
        cachedData.broadcast_packs.forEach(function (pack) {
            var row = broadcastTableBody.insertRow();
            row.insertCell(0).textContent = pack.pack_name;
            row.insertCell(1).textContent = pack.pack_price;
            row.insertCell(2).textContent = pack.channels;
            var selectButton = document.createElement("button");
            selectButton.textContent = "Select";
            selectButton.className = "btn btn-dark";
            selectButton.onclick = function () {
                window.location.href = "checkout.php?type=Broadcast&pack="+pack.pack_name+"&price="+pack.pack_price;
            };
            row.insertCell(3).appendChild(selectButton);
        });
        

        var channelsPackButton = document.getElementById("channelsPackButton");
        channelsPackButton.onclick = function () {
            var channelsPackForm = document.getElementById("channelsPackForm");
            channelsPackForm.submit();
        }

    // Populate Channels Pack Table
    cachedData.channels_pack.forEach(function (pack) {
        var row = channelsPackTableBody.insertRow();
        row.insertCell(0).textContent = pack.pack_name;
        row.insertCell(1).textContent = pack.pack_price;
        row.insertCell(2).textContent = pack.channels;
        var checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');
        checkbox.setAttribute('name', 'channel_list[]');
        checkbox.setAttribute('value', pack.pack_id);
        row.insertCell(3).appendChild(checkbox);
    });

    var allchannelsPackButton = document.getElementById("allchannelsPackButton");
    allchannelsPackButton.onclick = function () {
        var allchannelsPackForm = document.getElementById("allchannelsPackForm");
        allchannelsPackForm.submit();
        }
    
    // Populate All Channels Table
    cachedData.all_channels.forEach(function (channel) {
        var row = allChannelsTableBody.insertRow();
        row.insertCell(0).textContent = channel.channel_name;
        row.insertCell(1).textContent = channel.price;
        var checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');
        checkbox.setAttribute('name', 'channel_list[]');
        checkbox.setAttribute('value', channel.channel_id);
        row.insertCell(2).appendChild(checkbox);
    });

        // ... Rest of your JavaScript code ...
    </script>
    <script src="jquery.min.js"></script>
    <script>
    // Show the first tab and hide the rest
    $("#recharge li:first-child a").addClass("active");
    $(".tab-pane").removeClass("show");
    $(".tab-pane:first").addClass("active");
    $(".tab-pane:first").addClass("show");

    $("#recharge li ").click(function() {
        $("#recharge li a").removeClass("active");
        $(this).find("a").addClass("active");
        $("#recharge-category div").removeClass("active");
        $("#recharge-category div").removeClass("show");
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).addClass("show");
        $(activeTab).addClass("active");
        return false;
    });
    </script>

<script>
function allChannelsSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("allChannelsSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("allChannelsTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script>
function channelsPackSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("channelsPackSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("channelsPackTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script>
function broadcastSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("broadcastSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("broadcastTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!-- Your script includes -->
</body>

</html>
