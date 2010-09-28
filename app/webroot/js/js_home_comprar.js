function menu(obj, boolOver, boolChild, boolFinal)
{
	if(boolOver)
	{
		if(!boolFinal)
		{
			obj.className="itemOver";
		}
		else
		{
			obj.className="itemOverFinal";
		}
		
		if(boolChild)
		{
			obj.childNodes[4].style.display="inline";
		}
	}
	else
	{
		if(!boolFinal)
		{
			obj.className="item";
		}
		else
		{
			obj.className="pieMenu";
		}
		
		if(boolChild)
		{
			obj.childNodes[4].style.display="none";
		}
	}
}

function Submenu(obj, boolOver)
{
	if(boolOver)
	{
		obj.className="over";
	}
	else
	{
		obj.className="out";
	}
}