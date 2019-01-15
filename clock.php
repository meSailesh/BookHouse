
		<style type="text/css">
			$color: #181818;
$size: 400px;
$clockPadding: #{$size / 14.4};
$second-depth: 3px;
$second-color: #ec231e;
$minute-depth: 6px;
$minute-color: $color;
$hour-depth: 6px;
$hour-color: $color;
$smooth: true;
$square-clock: false;
*{box-sizing:border-box;}
body{
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #D2D2D2;
}


.clock-frame {
  width: $size;
  height: $size;
  padding: $clockPadding;
  background-color: #F7F7F7;
  box-sizing: content-box;
  @if not $square-clock {
    border-radius: #{$size/4.5};
  }
  box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
  
  &.closed{
    background-color: tomato;
  }
}

.clock{
  width: $size;
  height: $size;
  border: 5px solid $color;
  @if not $square-clock {
    border-radius: 50%;
  }
  background-color: white;
  box-shadow: inset 0 0 15px rgba($color ,0.75);
  position: relative;
  overflow: hidden;
  &::after{
    content: '';
    width: calc(#{$size} - 80px);
    height: calc(#{$size} - 80px);
    background-color: inherit;
    border-radius: 50%;
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: auto;
  }
}

.marker{
  height: calc(100% - 25px);
  width: #{$size / 80};
  background-color: lighten($color, 50%);
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  &:nth-of-type(3n+1){
    background: $color;
  }
  &:nth-of-type(2){
    transform: rotate(30deg);
  }
  &:nth-of-type(3){
    transform: rotate(60deg);
  }
  &:nth-of-type(4){
    transform: rotate(90deg);
  }
  &:nth-of-type(5){
    transform: rotate(120deg);
  }
  &:nth-of-type(6){
    transform: rotate(150deg);
  }

}

.hand{
  transform-origin: center bottom;
  position: absolute;
  z-index: 3;
  // top: 50%;
  bottom: 50%;
  left: 50%;
  width: #{$size/50};
  @if $smooth {
    transition: transform 1s linear;
  } @else {
    transition: transform 0.2s cubic-bezier(0.4,2.08,0.55,0.44);
  }
  
  &.second{
    height: #{$size / 3};
    width: #{$size / 185};
    left: calc(50% - #{$second-depth/2});
    border-radius: #{$second-depth/2};
    background-color: $second-color;
    box-shadow: 4px 6px 0 0 rgba(0, 0, 0, 0.15);
    transform: rotate(40deg);
    // position: relative;
    z-index: 9;
    &::before,
    &::after{
      content: '';
      background-color: inherit;
      position: absolute;
      border-radius: 50%;
      left: 50%;
    }
    &::before {
      width: ($size / 20);
      height: ($size / 20);
      bottom: 0;
      transform: translate(-50%, 50%);
      box-shadow: 2px 2px 2px 0 rgba(0, 0, 0, 0.15);
    }
    &::after {
      width: #{$size / 36};
      height: #{$size / 36};
      top: #{$size / 15};
      transform: translate(-50%, 0);
      box-shadow: 4px 6px 2px 0 rgba(0, 0, 0, 0.15);
    }
  }
  
  &.minute{
    height: #{$size / 3};
    left: calc(50% - #{$minute-depth/2});
    border-radius: #{$minute-depth/2};
    background-color: $minute-color;
  }
  &.hour{
    height: #{$size / 4};
    left: calc(50% - #{$hour-depth/2});
    border-radius: #{$hour-depth/2};
    background-color: $hour-color;
  }
}

@keyframes rotateArms {
    from {transform: rotate(0);}
    to {transform: rotate(360deg);}
}
		</style>
		<script type="text/javascript">
			function storeIsOpen(){
  //   0 index is Sunday
  let openTime = [ 
      { open : -1, close : -1 },
      { open: 9, close : 18 },
      { open: 8, close : 22.30 },
      { open: 9, close : 18 },
      { open: 9, close : 18 }, 
      { open: 9, close : 18 },
      { open: 10, close : 16.5 }
    ];

  let current = new Date();
  let day = current.getDay();
  let currentTime = current.getHours() + (current.getMinutes()/60);
  let remainTime = 0;
  
  if (openTime[day].open >= 0 && openTime[day].open < currentTime && openTime[day].close > currentTime) {
    remainTime= (openTime[day].close  - currentTime).toFixed(2);
    document.getElementById("storetime").innerHTML = "the shop will close in " + remainTime+ " hours"
  } else {
    document.querySelector(".clock-frame").classList.add("closed");
  }
  
  console.log("the shop will close in hours", remainTime);
}


let secondPlus = 0;
function getTime() {
  let date = new Date(),
    seconds = date.getSeconds() * 6,
    minutes = date.getMinutes() * 6,
    hours = (date.getHours() % 12) * 30 + minutes / 15;
  if(seconds == 0){
    secondPlus += 360;
  }
  document.querySelector(".hand.second").style.transform = "rotate( " + (seconds + secondPlus) + "deg)";
  document.querySelector(".hand.minute").style.transform = "rotate( " + minutes + "deg)";
  document.querySelector(".hand.hour").style.transform = "rotate( " + hours + "deg)";
}

storeIsOpen();
setInterval(function() {
  getTime();
}, 1000);
		</script>
		<div id="storetime">Time</div>
<div class="clock-frame">
  <div class="clock">
    <div class="marker"></div>
    <div class="marker"></div>
    <div class="marker"></div>
    <div class="marker"></div>
    <div class="marker"></div>
    <div class="marker"></div>

    <div class="hand second"></div>
    <div class="hand minute"></div>
    <div class="hand hour"></div>
  </div>
</div>