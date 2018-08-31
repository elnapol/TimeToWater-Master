
        let tempVal = <?php echo $var1; ?>;
        let humVal = <?php echo $var2; ?>;
        let humTiVal = <?php echo $var6; ?>;

        $("#displayTemperatura").sevenSeg({ digits: 5, value: tempVal + 0.01});
        $("#displayHumedad").sevenSeg({
            digits: 5,
            value: humVal + 0.01,
            colorOff: "#003200",
            colorOn: "lime",
            slant:0
        });
        $("#displayHumedadTi").sevenSeg({
            digits: 5,
            value: humTiVal + 0.01,
            colorOff: "#332200",
            colorOn: "orange",
            slant:0
        });
