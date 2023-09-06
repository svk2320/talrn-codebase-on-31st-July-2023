<body class="hold-transition sidebar-mini sidebar-collapse">
  <style>
    pre {
      font: inherit;
      /* This will inherit the font properties from the parent element (body) */
      text-align: left;
      white-space: pre-wrap;
    }

    .btn-close {
      padding-top: 0;
      padding-bottom: 0;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.8);
      position: absolute !important;
      right: 0;
      z-index: 2;
      padding: 1.05rem 1rem;
      background: none;
      border: 0;
      line-height: 1;
      transition: all 0.2s ease-in-out;
    }

    .me-2 {
      margin-right: 0.5rem !important;
    }

    .ms-1 {
      margin-left: 0.25rem !important;
    }
  </style>
  <!-- Add this line before the closing </body> tag -->
  
<?php
	// Get CodeIgniter instance to access the framework's resources
    $ci =& get_instance();
    
    $CI =& get_instance();
    $CI->load->library('session');
    
    $showPopup = filter_var($_SESSION['showPopup'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
    
    $showPopp = $_SESSION;

    // Load the model
    $ci->load->model('Model_notification');
    
    $user_type = 'client';
    
    $lastThreeNotification = $ci->Model_notification->getLastThreeNotificationForClient();

    if(count($lastThreeNotification)){
        // Call the method and assign the result to the variable
        $notification = $lastThreeNotification[0];

        $notificationCount = $notification['active'] ? 1 : 0;
    } else {
        $notificationCount = 0;
    }
?>

<script>
    var dataFromPHP = <?php echo json_encode($lastThreeNotification); ?>;
    console.log(dataFromPHP); // Log the data to the browser's console
</script>

<?php
    if ($notificationCount){
         $nam = $notification['id'] . $notification['title'] . $notification['created_at'] . ($notification['admin'] ? 'A' : '') . ($notification['website'] ? 'W' : '') . ($notification['organisation'] ? 'O' : '') . ($notification['individual'] ? 'I' : '') . ($notification['client'] ? 'C' : '') . $notification['expiration_date'];
        
        //   if(in_array('viewAdmin', $user_permission)){
        //      $user_type = "admin";
        //   } elseif (isset($_SESSION['registered_as']) && $_SESSION['registered_as'] == 2) {
        //       $user_type = "individual";
        //   } elseif(isset($_SESSION['registered_as']) && $_SESSION['registered_as'] == 1) {
        //     $user_type = 'organisation';
        //   } else {
        //       $user_type = 'website';
        //   }
          
            if ($notification['client']){
                $show = 1;
                $nam .= 'client';
                
                // $lastThreeNotification = $ci->Model_notification->getLastThreeNotificationForAdmin();
            } else {
                $show = 0;
                $nam .= $user_type;
            }
            
        } else {
            $show = 0;
            $nam = '';
        }
?>

  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style=""> <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a> </li>
        <li class="nav-item d-none d-sm-inline-block"> <a href="<?php echo base_url('client') ?>"
            class="nav-link active" id="mainNav">Home</a> </li>
      </ul> <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto"> <!-- Notifications Dropdown Menu -->
        
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <?php if($notificationCount): ?>
                <span class="badge badge-warning navbar-badge" id="notificationCount" style="right: 8px !important; display: none; background: red; color: red;">1</span>
              <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationDropdown">
                <span class="dropdown-header">Notifications</span>
            </div>
        </li>

      </ul>
    </nav>

<script>
    const notifications = dataFromPHP;

function generateModalHTML(notification, i) {
    return `
        <div class="modal fade" id="${'notification' + i}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin: 0px auto;">${notification.title}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 0px; padding: 0px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <pre>${notification.text}</pre>
                    </div>
                    <div class="modal-footer d-flex justify-content-between position-relative">
                        <div class="d-flex justify-content-center flex-fill">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
}

// Function to append the generated HTML to the DOM
function appendModalToDOM(html) {
    const modalContainer = document.createElement('div');
    modalContainer.innerHTML = html;
    document.body.appendChild(modalContainer);
}

// Generating and appending the modal for each notification
for (let i = 0; i < notifications.length; i++) {
    const notification = notifications[i];
    const modalHTML = generateModalHTML(notification, i);
    appendModalToDOM(modalHTML);
}
</script>
    
<script>
    // JavaScript code to show/hide the notification span
    var showNotification = <?php echo $show ? 'true' : 'false'; ?>;
    var notificationSpan = document.getElementById("notificationCount");
    if("<?php $notificationCount ?>"){
        notificationSpan.style.display = showNotification ? "block" : "none";
        console.log(showNotification ? "block" : "none");
    }
</script>


    <?php if($show): ?>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle" style="margin: 0px auto;"><?= $notification['title'] ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 0px; padding: 0px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <pre>
<?= $notification['text'] ?>
              </pre>
          </div>
          
        <div class="modal-footer d-flex justify-content-between position-relative">
          <div class="d-flex justify-content-center flex-fill">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
          </div>
          <button type="button" id="skipButton" class="btn btn-link position-absolute" style="right: 3%;" data-dismiss="modal">Skip</button>
        </div>
        </div>
      </div>
    </div>

<?php endif; ?>

<script>
    // Decode the JSON data
    const notificationData = dataFromPHP;

    // Get the dropdown menu element
    const dropdownMenu = document.getElementById("notificationDropdown");

    // Helper function to calculate the time difference
    function getTimeDifference(expirationDate) {
        const now = new Date();
        const expiration = new Date(expirationDate);
        const timeDifferenceMs = now - expiration;
        const secondsDifference = Math.floor(timeDifferenceMs / 1000);
        const minutesDifference = Math.floor(secondsDifference / 60);
        const hoursDifference = Math.floor(minutesDifference / 60);
        const daysDifference = Math.floor(hoursDifference / 24);

        if (daysDifference > 0) {
            return `${daysDifference} day${daysDifference === 1 ? '' : 's'} ago`;
        } else if (hoursDifference > 0) {
            return `${hoursDifference} hour${hoursDifference === 1 ? '' : 's'} ago`;
        } else if (minutesDifference > 0) {
            return `${minutesDifference} minute${minutesDifference === 1 ? '' : 's'} ago`;
        } else {
            return `${secondsDifference} second${secondsDifference === 1 ? '' : 's'} ago`;
        }
    }
    
    function removeHTMLTags(text) {
        return text.replace(/<[^>]*>/g, '');
    }

    // Create and append the dropdown items
    for (i = 0; i < notificationData.length; i++) {
        const dropdownItem = document.createElement("a");
        dropdownItem.href = "#notification" + i;
        dropdownItem.classList.add("dropdown-item");
        dropdownItem.setAttribute("data-toggle", "modal");

        const iconElement = document.createElement("i");
        iconElement.classList.add("notification.icon", "mr-2");
        dropdownItem.appendChild(iconElement);

        const textElement = document.createTextNode(removeHTMLTags(notificationData[i]["title"]).substring(0, 20));
        dropdownItem.appendChild(textElement);

        const timeElement = document.createElement("span");
        timeElement.classList.add("float-right", "text-muted", "text-sm");
        
	// Assuming notificationData[i]["created_at"] is in the format "YYYY-MM-DD HH:mm:ss"
        const createdAtValue = notificationData[i]["created_at"];
        
        // Split the string to get the date part
        const datePart = createdAtValue.split(" ")[0];
        
        // Split the date part to get year, month, and day
        const [year, month, day] = datePart.split("-");
        
        // Rearrange the parts in the "DD-MM-YYYY" format
        const formattedDate = `${day}-${month}-${year}`;
        
        // Now, display the date part where you need it (e.g., in the timeElement.textContent)
        timeElement.textContent = formattedDate;

        dropdownItem.appendChild(timeElement);

        const dividerElement = document.createElement("div");
        dividerElement.classList.add("dropdown-divider");

        dropdownMenu.appendChild(dropdownItem);
        dropdownMenu.appendChild(dividerElement);
    }
    
    // After the for loop ends, add the "See All Notifications" link as a footer
    const dividerElement = document.createElement("div");
    dividerElement.classList.add("dropdown-divider");
    dropdownMenu.appendChild(dividerElement);

    const seeAllNotificationsLink = document.createElement("a");
    seeAllNotificationsLink.href = "<?= base_url('client/announcements/show_all_popups') ?>";
    seeAllNotificationsLink.classList.add("dropdown-item", "dropdown-footer");
    seeAllNotificationsLink.textContent = "See All Notifications";
    dropdownMenu.appendChild(seeAllNotificationsLink);
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Set the PHP value to JavaScript variable
  combinedData = "<?php echo $nam; ?>";
   
  // Function to be executed when the modal is closed
  function onModalClose() {
    var notificationSpan = document.getElementById("notificationCount");
    // Change the display style to "none"
    notificationSpan.style.display = "none";
  }

  $(document).ready(function() {
    let skipButtonClicked = false; // Variable to keep track of skip button click

    const skipButton = document.getElementById('skipButton');

    skipButton.addEventListener('click', function() {
      skipButtonClicked = true; // Mark the skip button as clicked
      $('#exampleModalCenter').modal('hide');

      // Rest of the code for skip button click event...
      // Prepare the data to be sent via AJAX
      let formData = new FormData();
      formData.append("showPopup", false);

      var base_url = "<?php echo base_url(''); ?>";

      // Send the data via AJAX to the server
      $.ajax({
        url: base_url + 'admin/updatesession/setNewSession',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response);
        },
        error: function (xhr, status, error) {
          // Handle the error case
          console.error(error);
        },
      });

      function deleteCookie(name) {
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      }

      // Make an AJAX request to update the $show variable on the server-side
      $.ajax({
        url: '', // Replace with the URL to the server-side PHP script that handles the update
        method: '', // Change to 'GET' if appropriate
        data: { show: 0 }, // Data to be sent to the server
        success: function(response) {
          deleteCookie(combinedData);
        },
        error: function() {
          // Handle any errors that occurred during the AJAX request
        }
      });
    });

    // Attach event listener to the modal's 'hidden.bs.modal' event
    $('#exampleModalCenter').on('hidden.bs.modal', function() {
      // Call the function when the modal is closed, only if the skip button was not clicked
      if (!skipButtonClicked) {
        onModalClose();
      }

      // Reset the skipButtonClicked variable for future interactions with the modal
      skipButtonClicked = false;
    });
  });
</script>

<script>
    <?php if ($showPopup == false) { ?>
        var notificationSpan = document.getElementById("notificationCount");
        
        notificationSpan.style.display = "block";
    <?php } ?>
</script>

<script>
  <?php if (isset($show) && isset($showPopup) && ($show && $showPopup)) { ?>
    $(document).ready(function () {
        // Access the span element by its id
        var notificationSpan = document.getElementById("notificationCount");
          
        // Check if the cookie exists (indicating the modal was shown before)
        if (!getCookie(combinedData)) {
          // If the cookie doesn't exist, show the modal
          $('#exampleModalCenter').modal('show');
          
          // Change the display style to "none"
          notificationSpan.style.display = "block";
          
          // Set a cookie to prevent the modal from showing again
          var expirationDate = new Date("<?= date('Y-m-d', strtotime($notification['expiration_date'])) ?>"); // Format the date in PHP to match the JavaScript date format
          expirationDate.setDate(expirationDate.getDate() + 1);
          setCookie(combinedData, 'true', expirationDate);
        } else {
            notificationSpan.style.display = "none";
        }
    });

    // Function to get a cookie value (Make sure this function is defined)
    function getCookie(name) {
      var value = "; " + document.cookie;
      var parts = value.split("; " + name + "=");
      if (parts.length === 2) return parts.pop().split(";").shift();
    }

    // Function to set a cookie (Make sure this function is defined)
    function setCookie(name, value, expirationDate) {
      var expires = "expires=" + expirationDate.toUTCString();
      document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
  <?php } ?>
</script>
