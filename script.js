//this function displays a particular div
//if display = none and vice versa

function displayEntry(value)
{

	var x = document.getElementById(value);

        if(x.style.display === "none")
         {
               x.style.display = "block";
         }
         else
         {
               x.style.display = "none";
         }

}


