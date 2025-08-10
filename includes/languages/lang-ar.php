<?php
    function lang($phrase)
    {
        static $lang = array(
            // Nave
            'LOGIN/REGISTER' => 'التسجيل/تسجيل الدخول',
            'SUPPORT' => 'الدعم',
            'CART' => 'عربة التسوق',
            'DELETES ALL' => 'حذف الكل',
            'TOTAL PRICE' => 'السعر الكلي',
            'TOTAL ITEMS' => 'إجمالي المنتجات',
            'PROCEED' => 'تابع العمليه',

            'PROFILE' => 'الحساب',
            'VIEW PROFILE' => 'عرض الصفحة الشخصية',
            'VIEW ORDER' => 'عرض الطلبات',
            'VIEW INFORMATION' => 'عرض المعلومات',
            'LOGOUT' => 'تسجيل خروج',

            // form
            'NAME' => 'الأسم*',
            'ORDER ID' => 'رقم التعريف الخاص بالطلب*',
            'EMAIL ADDRESS' => 'عنوان البريد الإلكتروني*',
            'COMMENTS' => 'تعليقك*',
            'USERNAME' => 'اسم المستخدم*',
            'NUMBER' => 'رقم التليفون*',
            'STREET' => 'الشارع*',
            'ZIP-CODE' => 'الرمز البريدي*',
            'PASSWORD' => 'كلمة المرور*',
            'NEW PASSWORD' => 'كلمة السر الجديدة*',
            'ENTER THE CODE' => 'ادخل الرمز*',
            'SHOW PASSWORD' => 'عرض كلمة المرور',
            'FORGET PASSWORD' => 'نسيت كلمة المرور؟',
            'SEND' => 'ارسل',
            'UPDATES' => 'تحديث',


            // error
            'EMPTY NAME' => 'لا يمكن أن يكون الاسم فارغًا.',
            'EMPTY LESS NAME' => 'لا يمكن أن يكون الاسم أقل من 4 أحرف.',
            'EMPTY MORE NAME' => 'لا يمكن أن يزيد الاسم عن 25 حرفًا.',
            'EMPTY EMAIL' => 'لا يمكن أن يكون البريد الإلكتروني فارغًا.',
            'EMPTY COMMENT' => 'لا يمكن أن يكون التعليق فارغًا.',
            'EMPTY ORDER ID' => 'لا يمكن أن يكون معرف الطلب فارغًا.',
            'EMPTY ORDER ID IS NOT' => 'معرف الطلب هذا غير موجود في سجلاتنا.',

            'EMPTY USERNAME' => 'لا يمكن أن يكون اسم المستخدم فارغًا.',
            'EMPTY TAKEN USERNAME' => 'أسم المستخدم مأخوذ مسبقا.',
            'EMPTY TAKEN EMAIL' => 'الايميل أخذ مسبقا.',
            'EMPTY PASSWORD' => 'لا يمكن أن تكون كلمة السر فارغة.',
            'EMPTY CHARACTERS PASSWORD' => 'كلمة السر لا يمكن أن تكون أقل من 8 أحرف.',
            'EMPTY LESS CHARACTERS USERNAME' => 'اسم المستخدم لا يمكن أن يكون أقل من 4 أحرف.',
            'EMPTY MORE CHARACTERS USERNAME' => 'لا يمكن أن يزيد اسم المستخدم عن 20 حرفًا.',
            'EMPTY NUMBER' => 'لا يمكن أن يكون الرقم فارغًا.',
            'EMPTY STREET' => 'لا يمكن أن يكون الشارع فارغًا.',
            'EMPTY ZIP CODE' => 'لا يمكن أن يكون الرمز البريدي فارغًا.',
            'EMPTY LOCATION' => 'لا يمكن أن يكون الموقع فارغًا.',
            'EMPTY VALID LOCATION' => 'يجب عليك اختيار موقع صالح.',
            'EMPTY CART' => 'عربة التسوق فارغة.',
            'EMPTY CHOOSE PAYMENT' => 'عليك أن تختار طريقة الدفع.',
            'EMPTY SOMETHING WENT WRONG' => 'حدث خطأ ما. أعد المحاولة من فضلك.',





            // section Home
            'MEAL' => 'وجبة',
            'OFFERS' => 'عروض',
            'ADD' => 'اضافة',
            'SALE' => 'تخفيض',
            'FINAL PRICE' => 'السعر النهائي',
            'ADD TO CART' => 'أضف إلى السلة',
            'EXTRAS' => 'إضافات',



            // support
            'RETURN THE ORDER' => 'مشكلة أو إرجاع الطلب',
            'COMPLAINTS OR COMMENTS' => 'الشكاوى أو التعليقات',
            'IF WANT TO CANCEL THE ORDER' => 'إذا كنت ترغب في إلغاء الطلب على الفور، اتصل بالرقم',
            'COMMENT OR COMPLAIN SENT SUCCESSFULLY' => 'تم إرسال التعليق أو الشكوى بنجاح.',
            'ORDER ID THAT WAS' => 'استخدم معرف الطلب الذي تم إرساله إليك.',

            // register
            'REGISTER' => 'تسجيل حساب', 
            'HAVE AN ACCOUNT' => 'هل لديك حساب؟', 
            'LOGIN NOW' => 'تسجيل الدخول الآن', 

            // login 
            'LOGIN' =>'تسجيل الدخول',
            'THE INFORMATION DOES NOT MATCH' =>'المعلومات التي أدخلتها لا تتطابق مع أي من سجلاتنا.',
            'Do NOT HAVE ACCOUNT' =>'ليس لديك حساب؟',
            'SIGN UP NOW' =>'أفتح حساب الأن',

            // Reset Password
            'RESET PASSWORD' => 'إعادة تعيين كلمة السر',
            'ENTER YOUR EMAIL' => 'أدخل بريدك الإلكتروني وسيتم إرسال الرمز إليك!',
            'VERIFY YOUR EMAIL' => 'قم بتأكيد بريدك الألكتروني',
            'PLEASE ENTER DIGIT' => 'الرجاء إدخال الرمز المكون من 4 أرقام الذي تم إرساله إليك.',
            
            // 404 error
            'PAGE NOT FOUND' => 'عفوًا! لم يتم العثور على الصفحة',
            'BACK TO HOME' => 'العودة إلى الصفحة الرئيسية',

            // cart 
            'NAME OF MEAL' => 'اسم_الوجبة',
            'EXTRAS MEAL' => 'اضافات_الوجبه',
            'PRICE MEAL' => 'سعر_الوجبه',
            'COUNTER MEAL' => 'عدد_الوجبه',
            'SAVE CHANGE' => 'حفظ_التغييرات',
            'EXTRAS TOTAL' => 'اجمالي_الاضافات',
            'MEAL TOTAL' => 'إجمالي_الوجبات',
            'CHECKOUT' => 'الدفع',
            'EMPTY CART MESSAGE' => 'عربة التسوق فارغة حاليا',
            'RETURN HOME' => 'العودة إلى الصفحة الرئيسية',

            // Profile
            'WELCOME'=>'مرحباً',
            'YOUR ORDERS'=>'طلباتك',
            'ALL ORDERS SITE'=>'جميع الطلبات تمت على الموقع.',
            'YOUR INFORMATION'=>'معلوماتك',
            'ALL YOUR DATA'=>'جميع البيانات الخاصة بك لتحريرها.',
            'DELETES ACCOUNT'=>'حذف الحساب',
            'ARE YOU DELETING ACCOUNT'=>'هل أنت متأكد من حذف حسابك؟!',
            'ALL YOUR INFORMATION DELETED'=>'*ملاحظة: سيتم حذف كافة المعلومات والأوامر الخاصة بك.',
            'YES' => 'نعم',
            'CLOSE' => 'اغلاق',
            'SOMETHING WENT WRONG' => 'حدث خطأ ما، أعد المحاولة لاحقًا.',
            'YOUR UPDATED SUCCESSFULLY' => 'لقد تم تحديث معلوماتك بنجاح.',
            'LEAVE IT TO BE CHANGED' => 'اتركه فارغًا إذا كنت لا تريد تغييره',


            // checkout & payment & orderConfirmation
            'PROMO CODE' => 'كوبون خصم',
            'APPLY THE CODE' => 'تطبيق الكود',
            'DO NOT FORGET BUILD NUMBER' => 'لا تنسى رقم البناء من فضلك.',
            'ADDRESS' => 'الشارع، رقم المنزل، الرمز البريدي*',
            'ORDER NOTES' => 'ملاحظات الطلب (اختياري)',
            'CHOOSE PAYMENT METHOD' => 'اختر طريقة الدفع.',
            'ONLINE PAYMENT' => 'الدفع اونلاين.',
            'PAYMENT UPON RECEIPT' => 'الدفع عند استلام الطلب.',
            'COUPON ADDED SUCCESSFULLY' => 'تمت إضافة القسيمة بنجاح.',
            'COUPON ENDED' => 'عذرا، انتهت القسيمة.',
            'NO COUPON' => 'عذرًا، لا يوجد مثل هذه القسيمة.',
            'CONFIRM ORDER AND PAYMENT'=> 'تم تأكيد الطلب وتم دفعه بنجاح، شكرًا لك على طلبك من جنان الشام.<br>تفضل بالتحقق من بريدك الإلكتروني لمعرفة تفاصيل طلبك.',
            'CONFIRM ORDER'=> 'تم تأكيد الطلب بنجاح، شكرًا لك على طلبك من جنان الشام.<br>تفضل بالتحقق من بريدك الإلكتروني لمعرفة تفاصيل طلبك.',






            // Footer
            'COPYRIGHT' => 'حقوق النشر © 2023 جنان الشام | تصميم وتطوير بواسطة',





        );
        return $lang[$phrase];
    }
?>