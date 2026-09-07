
using ITalent.Games.Tiled;
using OpenTK.Windowing.Common;
using OpenTK.Windowing.Desktop;
using OpenTK.Windowing.GraphicsLibraryFramework;
using System.Collections.Generic;
using System.Numerics;

namespace MyGameProject;

class Point
{
    public int X;
    public int Y;
}

internal class MyGame(GameWindowSettings gameWindowSettings, NativeWindowSettings nativeWindowSettings)
    : TileGameWindow(gameWindowSettings, nativeWindowSettings)
{
    private MapRenderLayer _blockLayer = new(HelloWorldTileSettings);

    private const int CYAN = 8;
    private const int RED = 12;
    private const int LAVA = 5;

    private List<Point> snake = new();

    private Random random = new();

    private int appleX;
    private int appleY;

    private int directionX = 1;
    private int directionY = 0;

    private double nextMove;


    protected override void OnLoad()
    {
        AddLayer(_blockLayer);
        base.OnLoad();

        int middleX = _blockLayer.Tiles.Size.X / 2;
        int middleY = _blockLayer.Tiles.Size.Y / 2;

        snake.Add(new Point { X = middleX, Y = middleY });
        snake.Add(new Point { X = middleX - 1, Y = middleY });

        appleX = random.Next(_blockLayer.Tiles.Size.X);
        appleY = random.Next(_blockLayer.Tiles.Size.Y);

        nextMove = 0.0;

        DrawGame();
    }


    protected override void OnUpdateFrame(FrameEventArgs e)
    {
        base.OnUpdateFrame(e);

        var input = KeyboardState;

        if (input.IsKeyDown(Keys.D) || input.IsKeyDown(Keys.Right))
        {
            directionX = 1;
            directionY = 0;
        }

        else if (input.IsKeyDown(Keys.A) || input.IsKeyDown(Keys.Left))
        {
            directionX = -1;
            directionY = 0;
        }

        else if (input.IsKeyDown(Keys.W) || input.IsKeyDown(Keys.Up))
        {
            directionX = 0;
            directionY = 1;
        }

        else if (input.IsKeyDown(Keys.S) || input.IsKeyDown(Keys.Down))
        {
            directionX = 0;
            directionY = -1;
        }


        if (Time.Total > nextMove)
        {
            Point head = snake[0];

            int newX = head.X + directionX;
            int newY = head.Y + directionY;


            if (newX < 0 || newX >= _blockLayer.Tiles.Size.X ||
                newY < 0 || newY >= _blockLayer.Tiles.Size.Y)
            {
                GameOver();
                return;
            }


            for (int i = 0; i < snake.Count; i++)
            {
                if (snake[i].X == newX && snake[i].Y == newY)
                {
                    GameOver();
                    return;
                }
            }


            snake.Insert(0, new Point { X = newX, Y = newY });


            if (newX == appleX && newY == appleY)
            {
                appleX = random.Next(_blockLayer.Tiles.Size.X);
                appleY = random.Next(_blockLayer.Tiles.Size.Y);
            }

            else
            {
                snake.RemoveAt(snake.Count - 1);
            }


            nextMove = Time.Total + 0.1;

            DrawGame();
        }
    }


    private void GameOver()
    {
        snake.Clear();

        int middleX = _blockLayer.Tiles.Size.X / 2;
        int middleY = _blockLayer.Tiles.Size.Y / 2;

        snake.Add(new Point { X = middleX, Y = middleY });
        snake.Add(new Point { X = middleX - 1, Y = middleY });

        directionX = 1;
        directionY = 0;
    }


    private void DrawGame()
    {
        _blockLayer.Tiles.Fill(CYAN);

        _blockLayer.Tiles.SetTile(appleX, appleY, LAVA);

        for (int i = 0; i < snake.Count; i++)
        {
            _blockLayer.Tiles.SetTile(snake[i].X, snake[i].Y, RED);
        }
    }


    static MapRenderLayerSettings HelloWorldTileSettings => new()
    {
        TilesetPath = "Resources/tetris.png",
        TilesetSize = new(4, 4),
        TilemapSize = new(40, 25),
        Align = AlignmentMode.CenterContain
    };
}

