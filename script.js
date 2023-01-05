$(document).ready(function () {
  $("#myTable").DataTable();
});

edits = document.getElementsByClassName("edit");
Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit ");
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    author = tr.getElementsByTagName("td")[1].innerText;
    edition = tr.getElementsByTagName("td")[2].innerText;
    public = tr.getElementsByTagName("td")[3].innerText;
    console.log(title, author, edition, public);
    titleEdit.value = title;
    authorEdit.value = author;
    editionEdit.value = edition;
    publicEdit.value = public;
    snoEdit.value = e.target.id;
    console.log(e.target.id);
    $("#editModal").modal("toggle");
  });
});

deletes = document.getElementsByClassName("delete");
Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit ");
    sno = e.target.id.substr(1);

    if (confirm("Are you sure you want to delete!")) {
      console.log("yes");
      window.location = `/LibraryManagementSystem/home.php?delete=${sno}`;
      // TODO: Create a form and use post request to submit a form
    } else {
      console.log("no");
    }
  });
});
