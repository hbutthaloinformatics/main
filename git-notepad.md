# Git Commands Reference Guide

## Basic Commands

### Setup
```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

### Initialize & Clone
```bash
git init                          # Initialize a new git repository
git clone <url>                   # Clone a remote repository
```

### Check Status
```bash
git status                        # Show current status
git log                           # Show commit history
git log --oneline                 # Show commit history in one line
git log -3                        # Show last 3 commits
git diff                          # Show unstaged changes
git diff --staged                 # Show staged changes
```

## Staging & Committing

```bash
git add <file>                    # Stage a specific file
git add .                         # Stage all changes
git commit -m "message"           # Commit with message
git commit -am "message"          # Stage and commit tracked files
```

## Pushing & Pulling

```bash
git push origin main              # Push to remote
git push origin main -f           # Force push (use carefully!)
git pull                          # Fetch and merge from remote
git pull origin main              # Pull specific branch
git pull --rebase                 # Rebase instead of merge
git fetch                         # Just fetch without merging
```

## Branching

```bash
git branch                        # List local branches
git branch <branch-name>          # Create new branch
git checkout <branch-name>        # Switch to branch
git checkout -b <branch-name>     # Create and switch to new branch
git merge <branch-name>           # Merge branch into current
git branch -d <branch-name>       # Delete branch
```

## Handling Diverged Branches

```bash
git log --oneline -5              # Check commit history
git log origin/main --oneline -5  # Check remote history
git diff origin/main <file>       # See differences
git rebase origin/main            # Rebase local on remote
git merge origin/main             # Merge remote into local
```

## Undoing Changes

```bash
git restore <file>                # Discard changes in working directory
git restore --staged <file>       # Unstage a file
git reset --hard origin/main      # Reset to remote version
git reset HEAD~1                  # Undo last commit (keep changes)
git revert <commit-hash>          # Create new commit that undoes changes
```

## Helpful Tips

### Avoid Branch Divergence
1. **Don't upload files via GitHub web interface**
   - Use `git push` instead

2. **Always pull before pushing**
   ```bash
   git pull
   git push origin main
   ```

3. **If divergence happens:**
   ```bash
   git pull origin main --rebase
   # or
   git fetch origin
   git rebase origin/main
   git push origin main
   ```

### Delete Local Commits (Be Careful!)
```bash
git reset --hard origin/main      # Discard all local commits
```

### View Remote Info
```bash
git remote -v                     # Show remote URLs
git fetch                         # Update remote tracking branches
```

## Common Workflow

```bash
# 1. Make changes to your files
# 2. Stage changes
git add .

# 3. Commit
git commit -m "Describe what changed"

# 4. Pull latest from remote
git pull origin main

# 5. Resolve any conflicts if needed

# 6. Push to remote
git push origin main
```

---
**Last Updated:** February 24, 2026
