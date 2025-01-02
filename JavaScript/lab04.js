function bookmarkList(List)
{	
	for (let i of List) {
		if (i.startsWith("https")) {document.write(`<a href="${i}">${i}<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" style="fill:green; vertical-align:middle;">
                        <path d="M12 2a5 5 0 00-5 5v4H4v13h16V11h-3V7a5 5 0 00-5-5zm3 9H9V7a3 3 0 016 0v4z"/>
                    </svg></a><br>`);}
		else {document.write(`<a href="${i}">${i} <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" style="vertical-align:middle; fill:red;">
                        <path d="M12 2a5 5 0 00-5 5v4H4v13h16V11h-3V7a5 5 0 00-5-5zm-2 9h8v2h-8v-2zm2-7a3 3 0 013 3v4h-6V7a3 3 0 013-3z"/>
                    </svg></a><br>`);}
	}
	
}

function palindrome(string) {
	const stringA = string.toLowerCase().replace(/[^a-z0-9]/g, "");
	const reversed =  stringA.split("").reverse().join("");
	if (reversed === stringA) {
		document.write(`<div style="color:green;">"${string}"</div>`);
		}
	else {
		document.write(`<div style="color:red;">"${string}"</div>`);
	}
}
