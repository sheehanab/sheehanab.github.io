function genMoves() {
  // declare initial variables
  var numberOfRings = document.getElementById("ringNumber").value;
  var numberOfMoves = 0;
  var outStack = [0];
  var outStackIt = 0;
  
  // declare poles
  var pole1 = [0];
  var pole2 = [0];
  var pole3 = [0];
  
  for(var i = 1; i <= numberOfRings; i++){
    pole1.push(i);
  }
  
  // Div elements 
  var div = document.createElement('div');
  div.innerHTML = "Generating your steps: ";
  document.getElementById('results').appendChild(div);
  
  while((pole1[pole1.length-1] != 0) || (pole2[pole2.length-1] !=0){
    // if the ring number is even 
    if(numberOfRings % 2 == 0){
      if(pole1[pole1.length-1] > pole2[pole2.length-1]){
        // copy top ring (pole 1) to next pole 
        pole2.push(pole1[pole1.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 1 --> 2";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole2[pole2.length-1] + " from pole 2 --> 1";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 2 to top of pole 1
        pole1.push(pole2[pole2.length-1]);
        // delete top of pole 2
        pole2.pop();
      }
      
      // increment moves
      numberOfMoves++;
      
      if(pole1[pole1.length-1] > pole3[pole3.length-1]){
        // copy top ring (pole 1) to pole 3
        pole3.push(pole1[pole1.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 1 --> 3";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole3[pole3.length-1] + " from pole 3 --> 1";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 3 to top of pole 1
        pole1.push(pole3[pole3.length-1]);
        // delete top of pole 3
        pole3.pop();
      }
      
      // increment moves
      numberOfMoves++;
      
      if(pole2[pole2.length] > pole3[pole3.length]){
        // copy top ring (pole 2) to pole 3
        pole3.push(pole2[pole2.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 2 --> 3";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole3[pole3.length-1] + " from pole 3 --> 2";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 3 to top of pole 2
        pole2.push(pole3[pole3.length-1]);
        // delete top of pole 3
        pole3.pop();
      }
      
      // increment moves
      numberOfMoves++;
    }
    // else if ring number is odd
    else if(numberOfRings % 2 == 1){
        if(pole1[pole1.length-1] > pole3[pole3.length-1]){
        // copy top ring (pole 1) to pole 3
        pole3.push(pole1[pole1.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 1 --> 3";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole3[pole3.length-1] + " from pole 3 --> 1";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 3 to top of pole 1
        pole1.push(pole3[pole3.length-1]);
        // delete top of pole 3
        pole3.pop();
      }
            
      // increment moves
      numberOfMoves++;
      
      if(pole1[pole1.length-1] > pole2[pole2.length-1]){
        // copy top ring (pole 1) to next pole 
        pole2.push(pole1[pole1.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 1 --> 2";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole2[pole2.length-1] + " from pole 2 --> 1";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 2 to top of pole 1
        pole1.push(pole2[pole2.length-1]);
        // delete top of pole 2
        pole2.pop();
      }
      
      // increment moves
      numberOfMoves++;
      
      if(pole2[pole2.length] > pole3[pole3.length]){
        // copy top ring (pole 2) to pole 3
        pole3.push(pole2[pole2.length-1]);
        var message = "Move ring size: " + pole1[pole1.length-1] + " from pole 2 --> 3";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        pole1.pop();
      }else{
        var message = "Move ring size: " + pole3[pole3.length-1] + " from pole 3 --> 2";
        outStack[outStackIt] = message;
        outStackIt++;
        console.log(message);
        // copy top of pole 3 to top of pole 2
        pole2.push(pole3[pole3.length-1]);
        // delete top of pole 3
        pole3.pop();
      }
      
      // increment moves
      numberOfMoves++;
    }
    
    // output moves:
    for(var i = 0; i < numberOfMoves; i++){
      para.innerHTML = para.innerHTML + outStack[i] + "<br>";
    }
    document.getElementById('results').appendChild(document.createElement('p'));
    
    var numMoves = document.createElement('p');
    numMoves.innerHTML = "Number of moves required to solve: " + numberOfMoves;
    documtent.getElementById('results').appendChild(numMoves);
}
