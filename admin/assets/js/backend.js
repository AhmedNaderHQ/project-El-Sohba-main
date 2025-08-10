// Confirmation Message On Button
$(".confirm").click(function () {
  return confirm("Are you sure?");
});

// Start Loading
$(window).on("load", function () {
  $(".loading-overlay .loader").fadeOut(500, function () {
    $(this)
      .parent()
      .fadeOut(500, function () {
        $("body").css("overflow", "auto");
        $(this).remove();
      });
  });
});

// End Loading

$(document).ready(function () {
  $(".toDOListPriority").show();
  $(".profileInformation").show();
  $(".PlatformSettings").show();
  $(".yourAddedItems").show();
  $(".messageProfile").hide();
  $(".allToDOList").hide();
});

$(".buttonAppProfile").click(function () {
  $(".toDOListPriority").show();
  $(".profileInformation").show();
  $(".PlatformSettings").show();
  $(".yourAddedItems").show();
  $(".messageProfile").hide();
  $(".allToDOList").hide();
});
$(".buttonMessageProfile").click(function () {
  $(".toDOListPriority").hide();
  $(".profileInformation").hide();
  $(".PlatformSettings").hide();
  $(".yourAddedItems").hide();
  $(".messageProfile").show();
  $(".allToDOList").hide();
});
$(".buttonListProfile").click(function () {
  $(".toDOListPriority").hide();
  $(".profileInformation").hide();
  $(".PlatformSettings").hide();
  $(".yourAddedItems").hide();
  $(".messageProfile").hide();
  $(".allToDOList").show();
});

/// Notifications counter
setInterval(function () {
  $.get("notifications.php", { do: "Count" }, function (notificationsCount) {
    $(".notificationsCount").html(notificationsCount);
  });
}, 1000);

/// Notifications

$(".notificationsTrigger").click(function () {
  let url = "notifications.php";
  let period = 1;
  var liList = document.getElementsByClassName("notificationItem");
  console.log(liList);

  $.get(url, { do: "View" }, function (notifications) {
    $(".notificationList").html(notifications);
  });

  setTimeout(function () {
    period = liList.length;
  }, 500);
  setTimeout(function () {
    var notificationsIds;
    // liList.forEach(li => {
    //   notificationsIds.push((li).attr("data-id"));
    // });

    $.get(url, { do: "Read" }, function (notifications) {});
  }, period * 1500);
});


/// tasks

$(".add-task").submit(function () {
  //1 - stop default behavior
  event.preventDefault();

  // 2 - get form data

  var text = $('input[name="text"]').val();
  var deadline = $('input[name="deadline"]').val();
  var assign = $('select[name="assign"]').val();
  var priority = $('select[name="priority"]').val();

  // 3 - send data to php with post request
  var url = "includes/requests/tasks.php";
  $.post(url, { text, deadline, assign, priority }, function (res) {
    $(".add-task").hide();
    $(".modelTask").append(res);
    $.get(url, { do: "Update" }, function (update) {
      $(".tableToDoList table tbody").html(update);
    });
  });
  $("input[type=text], input[type=datetime-local],select").val("");
});
$(".modelFooterTask button").click(function () {
  $(".add-task").show();
  $(".success-message").hide();
});




// delete Task

$(document).on("click", ".deleteTask", function () {
  let taskID = $(this).next(".taskID").html();

  $.get(
    "includes/requests/tasks.php",
    { do: "Delete", taskID: taskID },
    function (responseTaskDelete) {
      $("#exampleModalDelete" + taskID).removeClass("show");
      $(".tableToDoList table tbody").html(responseTaskDelete);
    }
  );
});

// show Added items by admin
$(document).on("click", ".seeMoreItems", function () {
  var AdminID = $(".AdminID").html();
  var showedItems = $(".showedItems").html();
  $(".showedItems").html(6 + Number(showedItems));
  $.get(
    "adminsItems.php",
    { do: "ShowItems", showedItems: showedItems, AdminID: AdminID },
    function (moreItems) {
      $(".moreItemsPlace").html(moreItems);
    }
  );
});


// Customers search
let customersTable = $(".customersTable").html();
$(".usernameSearch").keyup(function () {
  var username = $(this).val();
  if (username != "") {
    var op = "Search";
    $.get("./includes/requests/searchCustomers.php", { op, username }, function (searchResult) {
      $(".customersTable").html(searchResult);
    });
  } else if (username == "") {
    $(".customersTable").html(customersTable);
  }
});

// Items search
let itemsTable = $(".itemsTable").html();
$(".itemSearch").keyup(function () {
  var name = $(this).val();
  if (name != "") {
    var op = "Search";
    $.get("includes/requests/searchItems.php", { op, name }, function (searchResult) {
      $(".itemsTable").html(searchResult);
    });
  } else if (name == "") {
    $(".itemsTable").html(itemsTable);
  }
});

// Availability Items
$(document).on("click", ".availability", function () {
  var availability = $(this).html();
  var itemId = $(this).data(itemId);
  if (
    availability ==
    '<svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg><!-- <i class="fa-solid fa-check"></i> Font Awesome fontawesome.com -->'
  ) {
    $(this).html('<i class="fa-solid fa-xmark"></i>');
  } else if (
    availability ==
    '<svg class="svg-inline--fa fa-xmark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <i class="fa-solid fa-xmark"></i> Font Awesome fontawesome.com -->'
  ) {
    $(this).html('<i class="fa-solid fa-check"></i>');
  }
  $.get(
    "includes/requests/itemsAvailability.php",
    { availability, itemId },
    function (noRespond) {
      console.log(noRespond);
    }
  );
});

// Promoting Items
$(document).on("click", ".promotion", function () {
  var promotion = $(this).html();
  var itemId = $(this).data(itemId);
  if (
    promotion ==
    '<svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg><!-- <i class="fa-solid fa-check"></i> Font Awesome fontawesome.com -->'
  ) {
    $(this).html('<i class="fa-solid fa-xmark"></i>');
  } else if (
    promotion ==
    '<svg class="svg-inline--fa fa-xmark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <i class="fa-solid fa-xmark"></i> Font Awesome fontawesome.com -->'
  ) {
    $(this).html('<i class="fa-solid fa-check"></i>');
  }
  $.get("itemsPromotion.php", { promotion, itemId }, function (noRespond) {});
});
/// notification delete

$(document).on("click", ".notificationItem", function () {
  var id = $(this).attr("data-id");

  $.get("notifications.php", { do: "Delete", id }, function (noresults) {});
});

// Orders search
let Orders = $(".ordersTable").html();
$(".OrderIDSearch").keyup(function () {
  var orderID = $(this).val();
  if (orderID != "") {
    var op = "Search";
    $.get("includes/requests/searchOrders.php", { op, orderID }, function (searchResult) {
      $(".ordersTable").html(searchResult);
    });
  } else if (orderID == "") {
    $(".ordersTable").html(Orders);
  }
});

///  Comments view
$(".viewCommentBtn").click(function () {
  var status = $(this).parent().siblings("td.status").children("span").html();

  if (status == "Unread") {
    $(this).parent().siblings("td.status").children("span").html("read");
    $(this)
      .parent()
      .siblings("td.status")
      .children("span")
      .removeClass("bg-gradient-warning");
    $(this)
      .parent()
      .siblings("td.status")
      .children("span")
      .addClass("bg-gradient-primary");
    var commentId = $(this).data("id");
    $.get(
      "includes/requests/comments.php",
      { do: "Read", id: commentId },
      function (noRespond) {}
    );
  }
});
///  Comments delete
$(".deleteComment").click(function () {
  var comments = document.querySelectorAll(".commentTbody tr");
  if (comments.length > 1) {
    var commentId = $(this).data("id");
    $(this).parent().parent().parent().parent().parent().parent().remove();
    $.get(
      "includes/requests/comments.php",
      { do: "Delete", id: commentId },
      function (noRespond) {}
    );
  } else if (comments.length == 1) {
    var commentId = $(this).data("id");
    $(".commentTable").html(
      '<div class="card-body px-0 pt-2 pb-2"><ul class="list-group"><li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg"><div class="d-flex flex-column"><span class="text-dark font-weight-bold ms-sm-2">There\'s no comments to show.</span></div></li></ul></div>'
    );
    $.get(
      "includes/requests/comments.php",
      { do: "Delete", id: commentId },
      function (noRespond) {}
    );
  }
});

/// Notifications Settings form

// $(".notificationsSettings").submit(function () {
//   //1 - stop default behavior
//   event.preventDefault();

//   // 2 - get form data
//   $(".notificationsSettings input[type='submit']").on('click', function () {

//   });

//   // if ($('input[name="task"]').checked) {
//   //   console.log('on');
//   // } else {
//   //   console.log("off");
//   // }
//     // var task = $('input[name="task"]').val();
//     var deadline = $('input[name="deadline"]').val();
//   var assign = $('select[name="assign"]').val();
//   var priority = $('select[name="priority"]').val();
//   // console.log(task);
//   // 3 - send data to php with post request
//   // var url = "tasks.php";
//   // $.post(url, { task, deadline, assign, priority }, function (res) {
//   //   $(".add-task").hide();
//   //   $(".modelTask").append(res);
//   // });
//   // $.get(url, { do: "Update" }, function (update) {
//   //   $(".tableToDoList table tbody").html(update);
//   // });
//   // $("input[type=text], input[type=datetime-local],select").val("");
// });
// $(".modelFooterTask button").click(function () {
//   $(".add-task").show();
//   $(".success-message").hide();
// });
