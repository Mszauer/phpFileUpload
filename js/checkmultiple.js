var field = document.getElementById('filename');
field.addEventListener('change',countFiles, false);

funciton countFiles(e){
	if(this.files != undefined){
		var elems = this.form.elements,
			submitButton,
			len = this.files.length,
			max = document.getElementByName('MAX_FILE_SIZE')[0].value,
			maxfiles = this.getAttribute('data-maxfiles'),
			maxpost = this.getAttribute('data-maxpost'),
			displaymax = this.getAttribute('data-displaymax'),
			filesize,
			toobig = [],
			total = 0,
			message = '';

		for(var i = 0 ; i < elems.length; i++){
			if(elems[i].type === 'submit'){
				submitButton = elems[i];
				break;
			}
		}

		for( i=0; i < len; i++){
			fileSize = this.files[i].size;
			if(filesize > max){
				toobig.push(this.files[i].name);
			}
			total += filesize;
		}
		if (toobig.length > 0){
			message = "The following file(s) are too large:\n" + toobig.join('\n') + '\n\n';
		}
		if(total > maxpost){
			message += 'The combined total exceeds ' + displaymax + '\n\n';
		}
		if(len > maxfiles){
			message += 'You have sleected more than ' + maxfiles + ' files';
		}
		if(message.length > 0){
			submitButton.disabled = true;
			alert(message);
		} else{
			submitButton.disabled = false;
		}
	}
}