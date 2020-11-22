$loading2 = document.querySelector(".-fullpage-loading");

$loading2.classList.add("-show");

window.addEventListener("load", () => {
	$loading2.classList.remove("-show");
	let $body = document.querySelector("body");
	if ($body.classList.contains("home")) {
		let $buttonToggle = document.querySelector("#category-toggle");
		let $menuCategory = document.querySelector(".-class-class");
		$buttonToggle.addEventListener("click", function() {
			$menuCategory.classList.toggle("-show");
		});
	}
	if ($body.classList.contains("single-product")) {
		let $buyButton = document.querySelector(".add-request-quote-button");
		$buyButton.addEventListener("click", () => {
			setTimeout(() => {
				let $loading = document.querySelector(".-fullpage-loading");
				$loading.classList.add("-show");
				window.location.reload(1);
			}, 1000);
		});
	} else if (document.getElementById('rqa-email')){
		document.getElementById('rqa-email').addEventListener("input", ()=>{
			document.getElementById('rqa-email').value = document.getElementById('rqa-email').value.toLowerCase();
		});
	}

	if (document.getElementById('rqa-phone')) {

		let $inputPhone = document.getElementById('rqa-phone');
		
		$inputPhone.setAttribute( 'maxlength', 15 );

		function celphone(v) {
			v = v.replace(/\D/g, "");
			v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
			v = v.replace(/(\d{5})(\d)/, "$1-$2");
			return v;
		}
		function telphone(v) {
			v = v.replace(/\D/g, "");
			v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
			v = v.replace(/(\d{4})(\d)/, "$1-$2");
			return v;
		}
		$inputPhone.addEventListener("input", () => {
			let value = "";
			if ($inputPhone.value.length === 14) {
				value = telphone($inputPhone.value);
			} else {
				value = celphone($inputPhone.value);
			}
			$inputPhone.value = value;
		});
	}


	if (document.querySelector('input[type="tel"]')) {

		let $inputPhone = document.querySelector('input[type="tel"]');

		$inputPhone.setAttribute('maxlength', 15);

		function celphone(v) {
			v = v.replace(/\D/g, "");
			v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
			v = v.replace(/(\d{5})(\d)/, "$1-$2");
			return v;
		}
		function telphone(v) {
			v = v.replace(/\D/g, "");
			v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
			v = v.replace(/(\d{4})(\d)/, "$1-$2");
			return v;
		}
		$inputPhone.addEventListener("input", () => {
			let value = "";
			if ($inputPhone.value.length === 14) {
				value = telphone($inputPhone.value);
			} else {
				value = celphone($inputPhone.value);
			}
			$inputPhone.value = value;
		});
	}

});
