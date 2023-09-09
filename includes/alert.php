<head>
    <style>
        .toast {
            width: fit-content;
            position: absolute;
            right: 10px;
            border-radius: 12px;
            background: #fbca13;
            padding: 7px 0 5px 0;
            z-index: 5;
            overflow: hidden;
            transform: translateX(calc(100% + 30px));
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
        }

        .toast.active-alert {
            transform: translateX(0%);
        }

        .toast .toast-content {
            display: flex;
            align-items: center;
        }

        .toast-content .message {
            display: flex;
            flex-direction: column;
            margin: 0 20px;
        }

        .message h4 {
            font-size: 14px;
            font-weight: 400;
            color: black;
        }

        .toast .close {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            opacity: 0.7;
        }

        .toast .close:hover {
            opacity: 1;
        }

        .toast .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
        }

        .toast .progress:before {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: #4070f4;
        }

        .progress.active-alert:before {
            animation: progress 2s linear forwards;
        }

        @keyframes progress {
            100% {
                right: 100%;
            }
        }
/* 
        .toast.active~button {
            pointer-events: none;
        } */
    </style>
</head>

<?php if ($_SESSION['alert'] != NULL): ?>
    <div class="toast active-alert">
        <div class="toast-content">
            <div class="message">
                <h4 id="e_msg">
                    <?php echo $_SESSION['alert'];
                    $_SESSION['alert'] = NULL; ?>
                </h4>
            </div>
        </div>
        <!-- <i class="material-icons close">close</i> -->
        <div class="progress active-alert"></div>
    </div>
    </div>
<?php endif ?>

<script>
    const button = document.querySelector("button"),
        toast = document.querySelector(".toast");
    (closeIcon = document.querySelector(".close")),
        (progress = document.querySelector(".progress"));

    setTimeout(function () {
        toast.classList.remove("active-alert");
        progress.classList.remove("active-alert");
    }, 2000);

    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active-alert");
        progress.classList.remove("active-alert");
    })

    button.addEventListener("click", () => {
        toast.classList.add("active-alert");
        progress.classList.add("active-alert");
    });

</script>