$.post($form.attr('action'), $form.serialize(), function (response) {
  if (response.success) {
    // do something on success
  } else {
    $form.replaceWith(response.form);
  }
});
