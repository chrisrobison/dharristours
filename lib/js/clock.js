    function Clock (id) {
        this.id      = id;
        this.canvas  = document.getElementById(id);
        this.context = this.canvas.getContext('2d');
        this.canvas.__object__ = this;
        
        this.centerx = this.canvas.width / 2;
        this.centery = this.canvas.height / 2;
        
        this.properties = [];
        this.properties['clock.strokestyle'] = 'black';
        this.properties['clock.gutter']      = 25;
        this.properties['clock.shadow']      = true;
        this.properties['clock.numbers']     = true;
        this.properties['clock.background']  = true;
        this.properties['clock.digital']     = true;

        this.radius  = Math.min(this.canvas.width / 2, this.canvas.height / 2) - this.Get('clock.gutter');
    }


    /**
    * A setter
    * 
    * @param name  string The name of the property to set
    * @param value mixed  The value of the property
    */
    Clock.prototype.Set = function (name, value) {
        this.properties[name.toLowerCase()] = value;
    }


    /**
    * A getter
    * 
    * @param name  string The name of the property to get
    */
    Clock.prototype.Get = function (name) {
        return this.properties[name.toLowerCase()];
    }


    /**
    * Progressively draws the clock
    */
    Clock.prototype.Draw = function () {
        // First, clear the canvas
        this.canvas.width = this.canvas.width;

        this.Drawface();
        this.Drawnumbers();
        this.Drawsecond();
        this.Drawminute();
        this.Drawhour();
        this.DrawDigital();
    }


    /**
    * Draws the face of the clock
    */
    Clock.prototype.Drawface = function () {
        /**
        * Draw the background.face at all?
        */
        if (!this.Get('clock.background')) {
            return;
        }

        /**
        * If a shadow is requested, turn on the shadow, draw a circle, and then turn it off again
        */
        if (this.Get('clock.shadow')) {
            
            this.context.lineWidth = 2;
            this.context.strokeStyle = 'black';
            this.context.fillStyle = '#d0d0d0';
            this.context.beginPath();

            this.context.shadowColor = 'rgba(0,0,0,0.4)';
            this.context.shadowOffsetX = 4;
            this.context.shadowOffsetY = 4;
            this.context.shadowBlur = 7;
            
            this.context.beginPath();
            this.context.arc(this.centerx, this.centery, this.radius, 0, 6.28, 0);
            
            this.context.stroke();
            this.context.fill();
            
            // Now turn it off
            this.context.shadowColor = 'rgba(0,0,0,0)';
            this.context.shadowOffsetX = 0;
            this.context.shadowOffsetY = 0;
            this.context.shadowBlur = 0;
        }

        // Draw the main circle
            this.context.beginPath();
            this.context.strokeStyle = 'black';
            this.context.arc(this.centerx, this.centery, this.radius, 0, 6.28, 0);
            this.context.stroke();
        
        // Now draw the small ticks
            this.context.beginPath();
            var cnt = 0;
            for (var i=0; i<360; i+=6) {
                cnt = (cnt >= 5) ? 0 : (cnt + 1);
                this.context.arc(this.centerx, this.centery, this.radius, i/57.3, i / 57.3, 0);
                this.context.lineTo(this.centerx, this.centery);
            }
            this.context.lineWidth = 1;
            this.context.stroke();
            
            // Now draw a big white circle to create the tick marks
            this.context.fillStyle = '#f0f0f0';
            this.context.strokeStyle = '#c0c0c0';
            this.context.beginPath();
            this.context.arc(this.centerx, this.centery, this.radius - 5, 0, 6.28, 0);
            this.context.stroke();
            this.context.fill();
        
        /**
        * Draw the small centre bit
        */
        this.context.beginPath();
        this.context.fillStyle = '#666';
        this.context.strokeStyle = '#333';
        this.context.beginPath();
        this.context.arc(this.centerx, this.centery, 10, 0, 6.28, 0);
        this.context.stroke();
        this.context.fill();
    }


    /**
    * Draw the numbers on the clock
    */
    Clock.prototype.Drawnumbers = function () {
        if (!this.Get('clock.numbers')) {
            return;
        }

        var r = this.radius - 15;

        this.Drawtext('I', this.centerx + (0.45 * r), this.centery - (0.84 * r), 16, .16, 'right', 'top');
        this.Drawtext('II', this.centerx + (0.8 * r), this.centery - (0.5 * r), 16, .30, 'right', 'top');
        this.Drawtext('III', (this.centerx + this.radius) - 18, this.centery-10, 16, .5, 'center', 'center');
        this.Drawtext('IV', this.centerx + (0.866 * r), this.centery + (0.4 * r), 16, .67, 'right', 'bottom');
        this.Drawtext('V', this.centerx + (0.55 * r), this.centery + (0.8 * r), 16, .866, 'right', 'bottom');
        this.Drawtext('VI', this.centerx + 12, (this.centery + r) - 5, 16, 1, 'center', 'bottom');
        this.Drawtext('VII', this.centerx - (0.36 * r), this.centery + (0.89 * r), 16, 1.18, 'left', 'bottom');
        this.Drawtext('VIII', this.centerx - (0.73 * r), this.centery + (0.63 * r), 16, 1.34, 'left', 'bottom');
        this.Drawtext('IX', this.centerx - this.radius + 20, this.centery + 10, 16, 1.5, 'left', 'center');
        this.Drawtext('X', this.centerx - (0.83 * r), this.centery - (0.4 * r), 16, 1.66, 'left', 'bottom');
        this.Drawtext('XI', this.centerx - (0.54 * r), this.centery - (0.78 * r), 16, 1.86, 'left', 'top');
        this.Drawtext('XII', this.centerx - 15, 23 + this.Get('clock.gutter'), 16, 0, 'center', 'top');
    }
    
    
    /**
    * A function which draws some text
    */
    Clock.prototype.Drawtext = function (text, x, y, size, rot) {
        if (!rot) rot = 0;
        this.context.font = size + 'pt Times';
        this.context.fillStyle = 'black';
        var halign = arguments[5] ? arguments[5] : 'left';
        var valign = arguments[6] ? arguments[6] : 'bottom';
         
         /*
        // halign
        if (halign == 'right') {
            x -= this.context.measureText(text).width;
        } else if (halign == 'center') {
            x -= (this.context.measureText(text).width / 2);
        }

        // valign
        if (valign == 'top') {
            y += size;
        } else if (valign == 'center') {
            y += (size / 2);
        }
*/
        this.context.save();
            this.context.beginPath();
            this.context.translate(x, y);
            this.context.rotate(Math.PI * rot);
            this.context.fillText(text,0,0);
            
            this.context.stroke();
            this.context.fill();
            
        this.context.restore();
    }


    /**
    * Draws the second hand
    */
    Clock.prototype.Drawsecond = function () {
        var date = new Date();
        var s = date.getSeconds();

        this.context.lineWidth   = 2;
        this.context.lineCap     = 'round';
        this.context.strokeStyle = '#990000';

        this.context.beginPath();
        this.context.arc(this.centerx, this.centery, this.radius - 15, ((s/60) * 6.28) - 1.57, ((s/60) * 6.28) - 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);

        this.context.arc(this.centerx, this.centery, 15, ((s/60) * 6.28) + 1.57, ((s/60) * 6.28) + 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);
            
        this.context.shadowColor = 'rgba(0,0,0,0.4)';
        this.context.shadowOffsetX = 4;
        this.context.shadowOffsetY = 4;
        this.context.shadowBlur = 7;
     
        this.context.stroke();
    }


    /**
    * Draws the minute hand
    */
    Clock.prototype.Drawminute = function () {
        var date = new Date();
        var m = date.getMinutes();

        this.context.strokeStyle = 'black';
        this.context.lineWidth   = 5;
        this.context.lineCap     = 'round';

        this.context.beginPath();
        this.context.arc(this.centerx, this.centery, this.radius - 25, ((m/60) * 6.28) - 1.57, ((m/60) * 6.28) - 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);

        this.context.arc(this.centerx, this.centery, 15, ((m/60) * 6.28) + 1.57, ((m/60) * 6.28) + 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);
        
        this.context.stroke();
    }


    /**
    * Draws the hour hand
    */
    Clock.prototype.Drawhour = function () {
        var date = new Date();
        var h = date.getHours();
        
        /**
        * Account for 24h time
        */
        if (h >= 12) {
            h -= 12;
        }

        this.context.strokeStyle = 'black';
        this.context.lineWidth   = 7;
        this.context.lineCap     = 'round';

        this.context.beginPath();
        this.context.arc(this.centerx, this.centery, this.radius - 65, ((h/12) * 6.28) - 1.57, ((h/12) * 6.28) - 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);

        this.context.arc(this.centerx, this.centery, 15, ((h/12) * 6.28) + 1.57, ((h/12) * 6.28) + 1.57, 0);
        this.context.lineTo(this.centerx, this.centery);
        
        this.context.stroke();
    }

    /**
    * Draws the digital readout at the bottom of the clock
    */
    Clock.prototype.DrawDigital = function () {
        if (!this.Get('clock.digital')) {
            return;
        }

        /**
        * Now draw the digital readout at the bottom
        */
        var date = new Date();
        var hours   = String(date.getHours());
        var minutes = String(date.getMinutes());
        var seconds = String(date.getSeconds());

        
        // Now pad them to two chars minimum
        if (hours.length == 1)   hours   = '0' + hours;
        if (minutes.length == 1) minutes = '0' + minutes;
        if (seconds.length == 1) seconds = '0' + seconds;

        var str = hours + ':' + minutes + ':' + seconds;
        this.Drawtext(str, this.centerx, this.centery + this.radius + 12, 14, 0, 'center', 'center');
    }
