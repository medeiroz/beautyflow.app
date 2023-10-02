# Install

## Install Windows Terminal

[Windows terminal](https://docs.microsoft.com/en-us/windows/terminal/get-started)

## Configure WSL

### Open administrator powershell

Enabled WSL

```powershell
dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart
```

Restart your pc

Upgrade WSL

```powershell
dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart
```

Download and install update

[https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_x64.msi](https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_x64.msi)

Set default wsl to new version

```powershell
wsl --set-default-version 2
```

Install last ubuntu subsystem version on Microsoft Store

[Click here to install Ubuntu sub system](https://www.microsoft.com/store/productId/9NBLGGH4MSV6)

Set ubuntu to new version

```powershell
wsl --set-version Ubuntu 2
```

## Open Ubuntu tab on Windows Terminal

### Configure terminal and alias

#### Open `.bashrc` file and append alias/export

```bash
vim ~/.bashrc
```

#### Show current Branch name

```bash
parse_git_branch() {
     git branch 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/(\1)/'
}
export PS1="\[\e]0;\u@\h: \w\a\]${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w \[\e[91m\]\$(parse_git_branch)\[\033[00m\]\n$ "
```

Refresh terminal

```bash
source ~/.bashrc
```

### Configure SSH Key

Generate new SSH key (default options)

```bash
ssh-keygen
```

Copy public key and past on Github settings > New SSH Key

[Github settings > Keys](https://github.com/settings/keys)

### Make new folder and follow

```bash
mkdir ~/code && cd ~/code
```

### Clone Project

```bash
git clone git@github.com:medeiroz/beauty.flow.git
```

```bash
cd beauty.flow
```

Configure git user

```bash
git config user.name "Flavio Medeiros"
```

```bash
git config user.email "smedeiros.flavio@gmail.com"
```

Copy .env file

```bash
cp .env.example .env
```

Fill database variables in .env

### Start Sail

```bash
docker compose up -d
```

### Upgrade Dependencies

```bash
docker exec -it beautyflow_app composer update
docker exec -it beautyflow_app composer dump-autoload
```

### Create APP key

```bash
docker exec -it beautyflow_app artisan key:generate
```

### Run migrations and seed

```bash
docker exec -it beautyflow_app artisan migrate --seed
```

### install node dependencies

```bash
docker exec -it beautyflow_app npm install
```

## dev server

```bash
docker exec -it beautyflow_app npm run dev
```

# Open Project

#### VSCODE

-   Open VScode
-   Install Remote - WSL extension
-   Restart vscode
-   File > Open Folder
-   `Ctrl` + `L` or tab on path input
-   Write `\\wsl$` + `Enter`
-   Navigate to Ubuntu > home > YourUserName > code > beauty.flow
-   Select Folder

#### PHPSTORM

-   Open PHPStorm
-   File > Open...
-   Write or Select folder
-   Navigate to `\\wsl$` > Ubuntu > home > YourUserName > code > beauty.flow
-   Select Folder

## Check health

[https://beautyflow_app:9000/health?fresh](https://beautyflow_app:9000/health?fresh)
