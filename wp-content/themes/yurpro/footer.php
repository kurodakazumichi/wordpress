                </article>
            </main>

            <footer>
                <p>©Copyright Since 2017 <?php bloginfo("name"); ?> All Right Reserved.</p>
            </footer>
        </div>
        <?php wp_footer(); ?>
        <?php if(DEVELOP) { get_template_part("debug"); } ?>
    </body>
</html>