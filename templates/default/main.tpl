<!DOCTYPE html>
<html>

<head>
    {headers}
    <link rel='stylesheet' href='http://cdn.community.tf/assets/styles/style.css'>
    <script src="{vue}"></script>
    <link href="https://cdn.materialdesignicons.com/2.8.94/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body l="{language}">
    <div id="core">
        <!-- <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" data-url="http://paletteengine.com/post/1" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
        <div class='container header'>
            <img src='http://cdn.community.tf/assets/images/tf2_logo.png' class='header-logo'>
            <ul class='header-links white'>
                <li>#Header_Nav_Workshop</li>
                <li>#Header_Nav_Wiki</li>
                <li>#Header_Nav_Community</li>
            </ul>
            </ul>
            [LOGIN]
            <div class='header-user'>
                <a href='#'><img src='{avatar}' class='header-avatar'></a>
                <div class='header-username'>
                    <div class='white username'>{username}</div>
                    <i class="mdi mdi-logout"></i>
                    <span class='logout'><a href='/logout'>#Header_Profile_Logout</a></span>
                </div>
            </div>
            [/LOGIN]
        </div>
        <div class='logo-container'>
            <img class='logo-img' src='http://cdn.community.tf/assets/images/space-logo.png'>
        </div>
        <div class='main'>
            <div class='container pre-main'>
                <ul class='main-links white'>
                    <li class="{blog}"><a href="/blog">#PreMain_Nav_Blog</a></li>
                    <li class="{updates}"><a href="/updates">#PreMain_Nav_Updates</a></li>
                    <li class="{news}"><a href="/news">#PreMain_Nav_News</a></li>
                    <li>#PreMain_Nav_Other</li>
                </ul>
                <div class='play-banner stamping'>
                    <div class='small-container'>
                        <img class='small-logo' src='http://cdn.community.tf/assets/images/small_logo.png'>
                    </div>
                    <div class='play-button white'>
                        <span>#PreMain_Button_Play</span>
                    </div>
                </div>
            </div>
            <div class="flex bicol">
                <div class='posts'>
                    {content}
                </div>
                <div class='right-panels'>
                    <div class='container monthly-players right-panel'>
                        <div class="panel-title white">#Panels_Monthly_Title</div>
                        <div class='vcontainer monthly'>{monthly}</div>
                    </div>
                    <img src='http://cdn.community.tf/assets/images/workshop.png' class='banner-right'>
                    <div class='container right-panel'>
                        <div class="panel-title white">#Panels_Links_Title</div>
                        <div class='vcontainer links'>
                            <div><i class="mdi mdi-steam-box link-mini"></i>Steam Group</div>
                            <a href="https://twitter.com/TFCommunityTeam">
                                <div><i class="mdi mdi-twitter-box link-mini"></i>Twitter</div>
                            </a>
                            <a href="https://reddit.com/r/tf2">
                                <div><i class="mdi mdi-reddit link-mini"></i>Subreddit</div>
                            </a>
                        </div>
                    </div>
                    <div class='container right-panel'>
                        <div class="panel-title white">#Panels_Locale_Title</div>
                        <div class='vcontainer language'>
                            <select @change="ChangeLocales($event)">
                                <option v-for="loc in locales" :selected="loc.code == locale" :value="loc.code">
                                    {{loc.title}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_pre"></div>
            <div class="footer flex">
                <div class="col flex">
                    <div class="company_copyright palette"></div>
                    <div class="copyright">&copy; Palette Studios | 2019.</br>Palette Studios, the Palette Studios logo, community.tf are owned by Palette Studios.</br><a href="/terms">Terms of Service</a> | <a href="/privacy">Privacy Policy</a></a></div>
                </div>
                <div class="col flex">
                    <a href="https://valvesoftware.com"><div class="company_copyright valve"></div></a>
                    <div class="copyright">Valve, the Valve logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo are trademarks and/or registered trademarks of Valve Corporation. We are not affliated with Valve Corporation. All rights belong to Valve Corporation.</div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="http://cdn.community.tf/assets/scripts/community.js"></script>

</html>