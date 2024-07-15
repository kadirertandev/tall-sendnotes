import './bootstrap';

window.addEventListener("note-edit-success", function () {
  // alertify.notify('Note edited successfully!', 'success', 2, function () { console.log('dismissed'); });
  alertify.set('notifier', 'position', 'top-center');
  alertify.set('notifier', 'delay', '2');
  alertify.success('Note edited successfully!');
})

window.addEventListener("something-went-wrong", function () {
  alertify.set('notifier', 'position', 'top-center');
  alertify.set('notifier', 'delay', '2');
  alertify.error('Something went wrong!');
})