    <div class="footer">
        <div class="container">

            <div class="width-12 footerContent">
                <h1>THE FINANCIAL JOURNAL</h1>
                <div class="greyLine"></div>

                <div class="footerBlocks">

                    <div class="footerBlock">
                        <h4>Explore</h4>
                        <ul>
                            <?php foreach ($categories as $c) { ?>
                                <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?> News</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="footerBlock">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Contact Us</a></li>
                            <li><a href="">Accessibility</a></li>
                            <li><a href="">Careers</a></li>
                        </ul>
                    </div>

                    <div class="footerBlock">
                        <h4>Legal & Privacy</h4>
                        <ul>
                            <li><a href="">Terms & Conditions</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Cookie Policy</a></li>
                            <li><a href="">Manage Cookies</a></li>
                            <li><a href="">Copyright</a></li>
                        </ul>
                    </div>

                </div>

                <div class="foot">
                    <li>© 2026 Financial Journal News & Media Limited or its affiliated companies. All rights reserved. (dcr)</li>
                </div>

            </div>
        </div>