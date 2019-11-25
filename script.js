//this function displays a particular div
//if display = none and vice versa

function displayEntry(value)
{

	var x = document.getElementById(value); //get the item via their id

        if(x.style.display === "none")	//if they are hidden, show display
         {
               x.style.display = "block";
         }
         else	//if they are displayed , hide.
         {
               x.style.display = "none";
         }

}


