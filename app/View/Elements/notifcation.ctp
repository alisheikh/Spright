<script>

console.log('completed job');
            $.growl("Saved! <?php echo $message; ?>", {
                type: "success",

                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

            </script>