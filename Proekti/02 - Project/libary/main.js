//  From INDEX.PHP to LOGIN.PHP
document.getElementById('loginBtn').addEventListener('click', function(event) {
    window.location.href = 'login.php';
});
// LOGOUT TO INDEX.PHP
function logout() {
    window.location.href = 'index.php';
}

///////////////////////////////////////////////////////////////////////////

// LOGIN / SIGNUP FORM SWITCH
function showSignUpForm() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('signUpForm').style.display = 'block';
}

function showLoginForm() {
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('signUpForm').style.display = 'none';
}

function goBack() {
    window.location.href = 'index.php';
}

/////////////////////////////////////////////////////////////////////////
// SEARCH
function searchBooks() {
    // Declare variables
    var input, filter, cards, card, title, author, category, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    cards = document.getElementById('bookCards');
    card = cards.getElementsByClassName('col-md-3');

    // Loop through all cards, hide those that don't match the search query
    for (i = 0; i < card.length; i++) {
        title = card[i].querySelector('.card-title');
        author = card[i].querySelector('.card-text:nth-child(2)');
        category = card[i].querySelector('.card-text:nth-child(3)');
        txtValue = title.textContent || title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 || author.textContent.toUpperCase().indexOf(filter) > -1 || category.textContent.toUpperCase().indexOf(filter) > -1) {
            card[i].style.display = "";
        } else {
            card[i].style.display = "none";
        }
    }
}




/////////////////////////////////////////////////////////////////////////////////////////
function showBookDetails(bookId) {
    window.location.href = `books.php?id=${bookId}`;
}
/////////////////////////////////////////////////////////////////////////////////////////
// NOTES

$("#submitNote").click(function() {
    var bookId = $("#bookId").val();
    var noteContent = $("#noteContent").val();
    $.ajax({
      url: "crud_note.php",
      type: "POST",
      data: {
        bookId: bookId,
        noteContent: noteContent
      },
      success: function() {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Note added successfully!',
        }).then(function() {
          location.reload();
        });
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Failed to add note',
        });
        console.error(error);
      }
    });
  });

  function fetchNotesAndUpdateUI() {
    var bookId = $("#bookId").val();
    $.ajax({
      url: "crud_note.php",
      type: "GET",
      data: {
        id: bookId
      },
      success: function(response) {
        $("#notesContainer").html(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }

  $(".deleteNote").click(function() {
    var noteId = $(this).data('noteid');
    $.ajax({
      url: "crud_note.php",
      type: "POST",
      data: {
        deleteNote: true,
        noteId: noteId
      },
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: response,
        }).then(function() {
          $("#note_" + noteId).remove();
        });
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Failed to delete note',
        });
        console.error(error);
      }
    });
  });

/////////////////////////////////////////////////////////////////////////////////////////

//COMMENTS
$(document).ready(function() {
    $(".deleteComment").click(function() {
    var commentId = $(this).data('commentid');
    $.ajax({
      url: "delete_comment.php",
      type: "POST",
      data: {
        deleteComment: true,
        commentId: commentId
      },
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: response,
        }).then(function() {
          $("#comment_" + commentId).remove();
        });
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Failed to delete comment',
        });
        console.error(error);
      }
    });
  });

    $("#commentForm").submit(function(e) {
      e.preventDefault();
      var bookId = $("#bookId").val();
      var commentContent = $("#commentContent").val();
      $.ajax({
        url: "crud_comment.php",
        type: "POST",
        data: {
          bookId: bookId,
          commentContent: commentContent
        },
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Comment submitted successfully!',
          }).then(function() {
            location.reload();
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
});

////////////////////////////////////////////////////////////////////////////////////////