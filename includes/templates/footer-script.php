    <script src="layout/js/jquery-3.6.0.min.js"></script>
    <script src="layout/js/all.min.js"></script>
    <script src="layout/js/bootstrap.bundle.min.js"></script>
    <script src="layout/js/owl.carousel.min.js"></script>
    <script src="layout/js/owl.autoplay.min.js"></script>
    <script src="layout/js/front-end.js"></script>

    <!-- script chat -->
    <script>
        var autoScroll = true;
        $(document).ready(function() {
            getMessages();
            setInterval(function() {
                getMessages();
            }, 2000);
        });

        function getMessages() {
            // استرجاع الرسائل من الخادم باستخدام AJAX
            $.ajax({
                url: 'chat.php',
                type: 'GET',
                success: function(data) {
                    displayMessages(data);
                    // التمرير للأسفل عند إضافة رسالة جديدة
                    if (autoScroll) {
                        scrollToBottom();
                    }
                }
            });
        }

        function displayMessages(messages) {
            // عرض الرسائل في الصفحة
            var messagesDiv = $('#messages');
            messagesDiv.empty();

            for (var i = 0; i < messages.length; i++) {
                messagesDiv.append('<div class="msg-bubble mb-3"><div class="msg-info"><div class="msg-info-name">' + messages[i].username + '</div><div class="msg-info-time">' + messages[i].timestamp + '</div></div><div class="msg-text">' + messages[i].message + '</div></div>');
            }
        }

        function sendMessage() {
            var messageInput = $('#messageInput');
            var message = messageInput.val();
            // تحقق من أن حقل الرسالة غير فارغ
            if (message.trim() === "") {
                alert("يرجى إدخال رسالة قبل الإرسال.");
                return;
            }
            $.ajax({
                url: 'send.php',
                type: 'POST',
                data: {
                    message: message
                },
                success: function() {
                    messageInput.val('');
                    // استرجاع الرسائل لتحديث الشات
                    getMessages();
                    scrollToBottom();
                }
            });
        }

        function scrollToBottom() {
            // التمرير للأسفل
            var messagesDiv = $('#messages');
            messagesDiv.scrollTop(messagesDiv[0].scrollHeight);
        }

        // إضافة مراقب لحركة التمرير للتحكم في التمرير التلقائي
        $('#messages').scroll(function() {
            // قم بتحديث حالة التمرير التلقائي بناءً على موضع التمرير
            autoScroll = $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight;
        });
    </script>
