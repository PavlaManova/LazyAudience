<?php include './homepageController.php' ?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <header>
        <section id="user-info">
            <img id="profile-picture" src="<?php echo $avatar_img; ?>"></img>
            <p id="username" class="username">
                <?php echo $username; ?> <br>
                <?php echo $user_points; ?> pts
            </p>
        </section>
        <button id="log-out-btn" onclick="logout()"></button>
    </header>
    <section class="display-flex">
        <h1 id="site-name" onclick="showHomePage()">Lazy Audience</h1>
    </section>

    <nav>
        <ul>
            <li class="nav-item" id="sounds" onclick="navBtnPressed(this)">
                Sounds
            </li>
            <!-- <li class="nav-item" id="invitations" onclick="navBtnPressed(this)">
                Invitations
            </li> -->
            <li class="nav-item" id="create-event" onclick="navBtnPressed(this)">
                Create Event
            </li>
            <li class="nav-item" id="events" onclick="navBtnPressed(this)">
                Events
            </li>
        </ul>

        <figure id="line"></figure>
    </nav>

    <section id="hero" class="changable-content display-flex">
        <section id="resume-text">
            <h1>
                We can help you orchestrate your audience and We can save your palms
                from excessive clapping
            </h1>
            <button class="btn-big" onclick="navBtnPressed(document.getElementById('create-event'))">
                Create Event
            </button>
        </section>
        <section id="resume-img">
            <img id="hero-img" src="./images/lounge-big-sound-system.png" alt="sound-system-img" />
            <img id="" src="./images/lounge-megaphone.png" alt="sound-system-img" />
        </section>
    </section>

    <section id="sounds-content" class="hide changable-content display-flex">
        <h1>Your sounds</h1>
        <h2>Categories</h2>
        <section id="categories">
            <section class="category">
                <input type="checkbox" id="check1" class="category-accordion" />
                <label class="category-label" for="check1">Applause</label>
                <ul class="sounds">
                    <section class="hide">
                        <li class="sound">
                            <p class="sound-name">Sound 1</p>
                            <button class="btn-small">&#9654;</button>
                        </li>
                    </section>

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-applause-btn" onclick="openBuyPopUp(0)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check2" class="category-accordion" />
                <label class="category-label" for="check2">Laugh</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-laugh-btn" onclick="openBuyPopUp(1)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check3" class="category-accordion" />
                <label class="category-label" for="check3">Booing</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-booing-btn" onclick="openBuyPopUp(2)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check4" class="category-accordion" />
                <label class="category-label" for="check4">Bravo!</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-bravo-btn" onclick="openBuyPopUp(3)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check5" class="category-accordion" />
                <label class="category-label" for="check5">Whistle</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-whistle-btn" onclick="openBuyPopUp(4)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check6" class="category-accordion" />
                <label class="category-label" for="check6">Cheering</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-cheering-btn" onclick="openBuyPopUp(5)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check7" class="category-accordion" />
                <label class="category-label" for="check7">Disappointment</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-disappointment-btn" onclick="openBuyPopUp(6)">
                        Buy Sound
                    </button>
                </ul>
            </section>
            <section class="category">
                <input type="checkbox" id="check8" class="category-accordion" />
                <label class="category-label" for="check8">Distinct Chatter</label>
                <ul class="sounds">

                    <button class="btn-big buy-btn buy-sound-btn" id="buy-distinct-chatter-btn"
                        onclick="openBuyPopUp(7)">
                        Buy Sound
                    </button>
                </ul>
            </section>
        </section>
    </section>

    <section id="buy-sounds-wrapper" class="pop-up-wrapper hide display-flex">
        <section class="pop-up" id="buy-pop-up">
            <h1>Buy New Sound</h1>
            <button class="close-btn btn-small" onclick="closeBuyPopUp()">X</button>
            <section class="hide">
                <section class="pop-up-line single-sound-info" id="single-sound-info">
                    <p class="sound-to-buy-name flex-1"></p>
                    <p class="sound-to-buy-points flex-1"></p>
                    <button class="accept-btn btn-small" onclick="buySound()" id="buy-sound-btn">Buy</button>
                </section>
            </section>
        </section>
    </section>

    <!-- <section id="invitations-content" class="changable-content hide">
        <h1>Your Invitations</h1>
        <ul id="invitations-list" class="unordered-list">
            <section class="invitation">
                <p class="invitation-title">Invitation 1</p>
                <p class="invitation-time">15:20</p>
                <button class="accept-btn btn-small">Accept</button>
                <button class="deny-btn btn-small">Deny</button>
            </section>
        </ul>
    </section> -->

    <section id="create-event-content" class="changable-content hide">
        <h1>Create Event For Audience and Invite People</h1>
        <form id="create-event-form" method="POST" action='./events.php' enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="create-event-form-input" required />

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="create-event-form-input" />

            <label for="hour">Hour:</label>
            <input type="time" id="hour" name="hour" class="create-event-form-input" />

            <label for="description">Description:</label>
            <textarea id="description" name="description" class="create-event-form-input" maxlength="150"></textarea>

            <button type="button" class="btn-big" onclick="openUsersPopUp()">Invite People</button>

            <button type="submit" class="btn-big">Create</button>
        </form>
    </section>

    <section id="events-content" class="changable-content hide">
        <h1>Events You Are Hosting</h1>
        <ul id="events-host-list" class="unordered-list">
            <section class='hide'>
                <li class="event">
                    <p class="event-title">Event 1</p>
                    <p class="event-time">15:20</p>
                    <button class="btn-big">Enter</button>
                </li>
            </section>
        </ul>
        <h1>Events You Are Asigned to</h1>
        <ul id="events-list" class="unordered-list">
            <section class='hide'>
                <li class="event">
                    <p class="event-title">Event 1</p>
                    <p class="event-time">15:20</p>
                    <button class="btn-big">Enter</button>
                </li>
            </section>
        </ul>
    </section>

    <section class="pop-up-wrapper hide display-flex" id="users-wrapper">
        <section class="pop-up" id="users-pop-up">
            <h1>Invite Audience to Your Event</h1>
            <button class="close-btn btn-small" onclick="closeUsersPopUp()">X</button>
            <section class="hide">
                <section class="pop-up-line margin-bottom-15" id="single-user-info">
                    <p class="user-to-invite-username flex-1"></p>
                    <p class="user-to-invite-points flex-1"></p>
                    <button class="accept-btn btn-small">Invite</button>
                </section>
            </section>
        </section>
    </section>
</body>
<script src="./homepage.js"></script>

</html>