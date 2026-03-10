const board = document.getElementById("board");
const statusText = document.getElementById("status");
const resetBtn = document.getElementById("resetBtn");
const xScoreText = document.getElementById("xScore");
const oScoreText = document.getElementById("oScore");

let cells = [];
let boardState = ["", "", "", "", "", "", "", "", ""];
let currentPlayer = "X";
let gameActive = true;
let xScore = 0;
let oScore = 0;

const winningCombinations = [
  [0, 1, 2],
  [3, 4, 5],
  [6, 7, 8],
  [0, 3, 6],
  [1, 4, 7],
  [2, 5, 8],
  [0, 4, 8],
  [2, 4, 6]
];

function createBoard() 
{
 board.innerHTML = "";
 cells = [];

 for (let i = 0; i < 9; i++) 
  {
  const cell = document.createElement("div");
  cell.classList.add("cell");
  cell.setAttribute("data-index", i);
  cell.addEventListener("click", handleCellClick);
  board.appendChild(cell);
  cells.push(cell);
 }
}

function handleCellClick(event) 
{
  const clickedCell = event.target;
  const index = clickedCell.getAttribute("data-index");

  if (boardState[index] !== "" || !gameActive) 
  {
    return;
  }

  boardState[index] = currentPlayer;
  clickedCell.textContent = currentPlayer;
  clickedCell.classList.add("taken", "animate");


 if (checkWinner())
  {
    statusText.textContent = "Player " + currentPlayer + " Wins!";
    gameActive = false;

    if (currentPlayer === "X")
    {
      xScore = xScore + 1;
      xScoreText.textContent = xScore;
    }
    else
    {
      oScore = oScore + 1;
      oScoreText.textContent = oScore;
    }

    return;
  }

  switchPlayer();
}

function switchPlayer()
{
  if (currentPlayer === "X")
  {
    currentPlayer = "O";
  }
  else
  {
    currentPlayer = "X";
  }

  statusText.textContent = "Current Player: " + currentPlayer;


}

function checkWinner()
{
  for (let i = 0; i < winningCombinations.length; i++)
  {
    let a = winningCombinations[i][0];
    let b = winningCombinations[i][1];
    let c = winningCombinations[i][2];

    if (
      boardState[a] !== "" &&
      boardState[a] === boardState[b] &&
      boardState[a] === boardState[c]
    )
    {
      cells[a].classList.add("winner");
      cells[b].classList.add("winner");
      cells[c].classList.add("winner");
      return true;
    }
  }

  return false;
}

function checkDraw()
{
  for (let i = 0; i < boardState.length; i++)
  {
    if (boardState[i] === "")
    {
      return false;
    }
  }

  return true;
}

function resetGame()
{
  boardState = ["", "", "", "", "", "", "", "", ""];
  currentPlayer = "X";
  gameActive = true;
  statusText.textContent = "Current Player: X";
  createBoard();
}

resetBtn.addEventListener("click", resetGame);


createBoard();


