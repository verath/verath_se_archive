// JavaScript Document

selected= new Array();

function SelectedDelete(id)
{
	for (i=0; i<numCheckboxes; i++)
	{
		if('checkbox'+String(i) == id)
		{
			if(document.getElementById(id).checked)
			{
				selected[i]="true";
				
			}else
			{
				selected[i]="false";	
			}
		}
	}
}

function submitDeleteForm()
{
	
	document.getElementById('deleteIDs').value="";
	
	for(x in selected)
	{
		if(selected[x]=="true")
		{
			document.getElementById('deleteIDs').value+=" "+x;
		}
	}
	//alert(document.getElementById('deleteIDs').value);
	document.getElementById('DeleteForm').submit();
}

function checkAll()
{
	for (i=0; i<numCheckboxes; i++)
	{
		document.getElementById('checkbox'+String(i)).checked="checked";
		selected[i]="true"
	}
	
}

function uncheckAll()
{
	for (i=0; i<numCheckboxes; i++)
	{
		document.getElementById('checkbox'+String(i)).checked="";
		selected[i]="false"
	}
	
}